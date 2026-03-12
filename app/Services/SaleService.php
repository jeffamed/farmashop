<?php

namespace App\Services;

use App\Actions\CalculateTotal;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redis;

class SaleService
{
    public function __construct()
    {
    }

    public function search(array $data): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_Sale_C
    {
        $condition = $data['condition'];
        $search = $data['search'];
        return Sale::query()->with('customer', 'user')
            ->when($condition === 'customer', fn(Builder $q) => $this->searchByRelation($q, 'customer', $search))
            ->when($condition === 'user', fn($q) => $this->searchByRelation($q,'user',$search))
            ->latest('id')
            ->paginate($data['pagination']);
    }

    public function registerDetail(Sale $sale, array $details):void
    {
        $now = now();
        $data = collect($details)->map(fn($detail) => [
            'sale_id' => $sale->id,
            'product_id' => $detail['product_id'],
            'quantity' => $detail['quantity'],
            'unit_price' => $detail['unit_price'],
            'discount' => $detail['discount'],
            'total' => CalculateTotal::handle($detail),
            'created_at' => $now,
            'updated_at' => $now,
        ])->toArray();

        SaleDetails::insert($data);
    }

    public function validateAndUpdateStock($details)
    {
        $productIds = $details->pluck('product_id');
        $products = Product::whereIn('id', $productIds)
            ->lockForUpdate()
            ->get();
        $products->each(function ($product) use ($details) {
            $qtyByProd = collect($details)->where('product_id', $product->id)->sum('quantity');
            if ($product->stock < $qtyByProd){
                throw new \Exception("No hay suficiente stock para el producto {$product->name}");
            }
            $product->decrement('stock', $qtyByProd);
            //$product->box_stock = $product->stock / $product->unit_box;
            $product->save();
            $this->productMoreSaleCache($qtyByProd, $product->id);
        });
    }

    private function searchByRelation(Builder $query, string $relation, string $search)
    {
        $query->whereHas($relation, function ($q) use ($search) {
            $q->searchName($search);
        });
    }

    public function registerCache($sale): void
    {
        Redis::pipeline(function ($pipe) use ($sale) {
            $now = Carbon::now();
            $dayKey = "metrics:sales:day:" . $now->format('Y-m-d');
            $monthKey = "metrics:sales:month:" . $now->format('Y-m');
            $pipe->incrBy($dayKey, $sale->total);
            $pipe->incrBy($monthKey, $sale->total);

            if ($sale->user_id){
                $pipe->zincrBy("metrics:sales:seller:{$now->format('Y-m-d')}", $sale->total, $sale->user_id);
                $pipe->zincrBy("metrics:sales:seller:{$now->format('Y-m')}", $sale->total, $sale->user_id);
            }
        });
    }

    private function productMoreSaleCache(int $quantity, int $productId): void
    {
        Redis::pipeline(function ($pipe) use ($quantity, $productId){
            $now = Carbon::now();
            Redis::zIncrBy("metrics:products:more_sale:day:{$now->format('Y-m-d')}", 1, $productId);
            Redis::zIncrBy("metrics:products:more_sale:month:{$now->format('Y-m')}", 1, $productId);
        });
    }
}
