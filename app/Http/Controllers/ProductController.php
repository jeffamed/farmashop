<?php

namespace App\Http\Controllers;

use App\Dtos\StandardFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Usage;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProductController extends Controller
{
    public ProductService $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index(Request $request)
    {
        $filter = [
            'search' => $request->input('search', ''),
            'condition' => $request->input('input', 'name'),
        ];

        $products = Product::with('laboratory:id,name','type:id,name')
            ->latest('id')
            ->select('id', 'code', 'name', 'price', 'stock', 'laboratory_id', 'type_id')
            ->when($request->input('search', ''),
                fn($q, $name) => $this->productService->searchByCondition($q, $filter))
                ->paginate($request->integer('pagination', 10));

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated(), $request->array('usages.*.id'));
        $product->addMedia($request->file('image'))->toMediaCollection('images-product', 's3');
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        $data = Cache::store('redis')
            ->remember("product:{$product->id}", 3600,
                fn() => (new ProductResource($product->load('media')))->resolve()
            );

        return response()->json($data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))
                ->toMediaCollection('images-product', 's3');
        }
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

}
