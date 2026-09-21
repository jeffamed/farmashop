<?php

namespace App\Http\Controllers;

use App\Dtos\StandardFilter;
use App\Http\Requests\OptionResource;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public SupplierService $service;
    public function __construct()
    {
        $this->service = new SupplierService();
    }

    public function index(Request $request)
    {
        $inputDefault = $request->has('view') && $request->input('view') === 'options' ? 'name' : '';

        $data = new StandardFilter(
            search: (string) $request->input('search', ''),
            input: (string) $request->input('input', $inputDefault),
            pagination: $request->integer('pagination', 10),
            needPagination: $request->boolean('needPagination', true)
        );

        $suppliers = $this->service->getSuppliers($data);

        if ($request->input('view') === 'options') {
            return OptionResource::collection($suppliers);
        }
        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierRequest $request)
    {
        return new SupplierResource(Supplier::create($request->validated()));
    }

    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return new SupplierResource($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json();
    }
}
