<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Usage;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public ProductService $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index(Request $request)
    {
        $products = Product::latest('id')
            ->when($request->input('search', ''),
                fn($q, $name) => $q->searchByName($name))
                ->paginate($request->integer('pagination', 10));

        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated(), $request->array('usages.*.id'));
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->array('usages.*.id')) {
            $product->usages()->sync($request->array('usages.*.id'));
        }

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }

    private function search(Request $request)
    {
        return $this->productService->searchByCondition($request->toArray());
    }
}
