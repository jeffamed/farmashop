<?php

namespace App\Services;

use App\Actions\CalculateTotal;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Database\Eloquent\Builder;

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

    private function searchByRelation(Builder $query, string $relation, string $search)
    {
        $query->whereHas($relation, function ($q) use ($search) {
            $q->searchName($search);
        });
    }

}
