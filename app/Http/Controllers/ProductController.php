<?php

namespace App\Http\Controllers;

use App\Dtos\FilterProduct;
use App\Dtos\StandardFilter;
use App\Enums\AvailabilityProduct;
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
        $searchable = [
            'search' => $request->input('search', ''),
            'condition' => $request->input('input', 'name'),
        ];

        $filters = $request->array('moreFilter', []);
        if (count($filters) > 0){
            $filters = new FilterProduct(
                availability: isset($filters['availability']) ? AvailabilityProduct::from($filters['availability']) : null,
                laboratoryId: $filters['laboratory'] ?? null,
                usageId: $filters['usage'] ?? null,
                typeId: $filters['type'] ?? null,
            );
        }

        $products = Product::with('laboratory:id,name','type:id,name')
            ->latest('id')
            ->select('id', 'code', 'name', 'price', 'stock', 'laboratory_id', 'type_id')
            ->when($filters, fn($q) => $this->productService->filterByCondition($q, $filters))
            ->when($request->input('search', ''),
                fn($q, $name) => $this->productService->searchByCondition($q, $searchable))
                ->paginate(perPage: $request->integer('pagination', 10), page: $request->integer('page', 1));

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated(), $request->array('usages'));
        if ($request->hasFile('images')){
            #$product->addMedia($request->file('images'))->toMediaCollection('images-product', 's3');
            foreach ($request->file('images', []) as $image) {
                $product->addMedia($image)->toMediaCollection('images-product', 's3');
            }
        }
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        /*$data = Cache::store('redis')
            ->remember("product:{$product->id}", 3600,
                fn() => (new ProductResource($product->load(['type','media'])))->resolve()
            );*/
        $data = (new ProductResource($product->load(['type', 'lastOrderDetails', 'laboratory', 'presentation', 'location', 'supplier', 'usages:id,description','media'])))->resolve();

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
