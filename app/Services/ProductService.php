<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function __construct()
    {}

    public function create(array $data, array $usages): Product
    {
        $product = Product::create($data);
        $product->usages()->sync($usages);
        return $product;
    }
}
