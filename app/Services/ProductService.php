<?php

namespace App\Services;

use App\Dtos\RelationshipFilter;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Usage;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct()
    {}

    public function create(array $data, array $usages): Product
    {
        $product = Product::create($data);
        if (count($usages) > 0){
            $product->usages()->sync($usages);
        }
        return $product;
    }

    public function searchByCondition($query,array $data)
    {
        return match ($data['condition']) {
            'code' => $this->byCode($query, $data),
            'usage' => $this->byUsage($data['search']),
            'laboratory' => $this->byRelation($query, 'laboratory', $data),
            'type' => $this->byRelation($query, 'type', $data),
            'order' => $this->byOrder($data['search']),
            'reimbursement' => $this->byOrder($data['search'], 'reimbursement'),
            default => $query->searchByName($data['search']),
        };
    }

    public function byCode($query, array $data)
    {
        $request = new Request([
            'column' => 'code',
            'search' => $data['search']
        ]);
        return $query->searchColumn($request);
    }

    public function byRelation($query, string $modelRelation, array $data)
    {
        $filter = new RelationshipFilter(
            modelRelation: $modelRelation,
            search: $data['search']
        );

        return $query->searchByRelation($filter);
    }

    private function byUsage($search): Product|null
    {
        $product = Product::with('presentation')
            ->whereHas('usages', function ($query) use ($search) {
                $query->where('id', $search);
            })->first();

        if ($product) {
            $product['quantityOrder'] = 0;
            $product['discountOrder'] = 0;
        }
        return $product;
    }

    private function byOrder($search, $type = 'order'): Collection
    {
        $products = Product::with('presentation', 'orderDetails')
            ->whereHas('orderDetails', function ($query) use ($search) {
                $query->where('order_id', $search);
            })->get();

        $products->each(function ($product) use ($type) {
            $orderDetail = $product->orderDetails->first();
            $product['reimbursement'] = 0;
            $product['order'] = optional($orderDetail)->quantity;
            $product['unitPrice'] = optional($orderDetail)->unit_price;
            if ($type === 'reimbursement') {
                $product['discountOrder'] = optional($orderDetail)->discount;
            }
            $product['expire'] = optional($orderDetail)->expire_at;
        });
        return $products;
    }

    private function byName($search): Collection
    {
        return Product::with('presentation')
            ->searchName($search)
            ->take(25)
            ->get()
            ->each(function ($product) {
                $product['costOrder'] = 0;
                $product['quantityOrder'] = 0;
                $product['discountOrder'] = 0;
                $product['expireOrder'] = "";
                $product['pvp'] = 0;
            });
    }
}
