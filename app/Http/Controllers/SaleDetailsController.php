<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleDetailsRequest;
use App\Http\Resources\SaleDetailsResource;
use App\Models\SaleDetails;

class SaleDetailsController extends Controller
{
    public function index()
    {
        return SaleDetailsResource::collection(SaleDetails::all());
    }

    public function store(SaleDetailsRequest $request)
    {
        return new SaleDetailsResource(SaleDetails::create($request->validated()));
    }

    public function show(SaleDetails $saleDetails)
    {
        return new SaleDetailsResource($saleDetails);
    }

    public function update(SaleDetailsRequest $request, SaleDetails $saleDetails)
    {
        $saleDetails->update($request->validated());

        return new SaleDetailsResource($saleDetails);
    }

    public function destroy(SaleDetails $saleDetails)
    {
        $saleDetails->delete();

        return response()->json();
    }
}
