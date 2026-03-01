<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return SaleResource::collection(Sale::all());
    }

    public function store(SaleRequest $request)
    {
        return new SaleResource(Sale::create($request->validated()));
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale);
    }

    public function update(SaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());

        return new SaleResource($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json();
    }
}
