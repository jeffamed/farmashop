<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Dtos\SalesFilter;
use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;

class SaleController extends Controller
{
    public SaleService $saleService;
    public function __construct()
    {
        $this->saleService = new SaleService();
    }
    public function index(Request $request)
    {
        $filter = new SalesFilter($request->condition, $request->search, $request->integer('pagination', 10));
        $sales = $this->saleService->search($filter->toArray());
        return SaleResource::collection($sales);
    }

    public function store(SaleRequest $request)
    {
        $sale = Sale::create($request->validated());
        if ($request->filled('details')){
            $this->saleService->registerDetail($sale, $request->array('details'));
        }
        return new SaleResource($sale);
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale->load('details'));
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
