<?php

namespace App\Services;

use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct()
    {
    }

    public function create(array $data, array $usages): Product
    {
        $product = Product::create($data);
        $product->usages()->sync($usages);
        return $product;
    }

    public function searchByCondition(array $data)
    {
        return match ($data['condition']) {
            'code' => $this->byCode($data['search']),
            'usage' => $this->byUsage($data['search']),
            'order' => $this->byOrder($data['search']),
            'reimbursement' => $this->byOrder($data['search'], 'reimbursement'),
            default => $this->byName($data['search']),
        };
    }

    private function byCode($search): Product|null
    {
        $request = new Request([
            'search' => $search,
            'column' => 'code'
        ]);

        $products = Product::searchCode($request)->first();
        if ($products) {
            $products->presentacion = $products->presentation->name;
        }
        return $products;
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
            $product['order'] = optional($orderDetail)->orderQty;
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
