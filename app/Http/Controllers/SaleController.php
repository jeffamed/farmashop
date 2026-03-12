<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Dtos\SalesFilter;
use Carbon\Carbon;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\Redis;
use function PHPUnit\Framework\throwException;

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
        $data = $request->validated();
        $data['user_id'] = \Auth::id();
        $sale = \DB::transaction(function () use ($data, $request){
            $details = collect($request->array('details'));
           $this->saleService->validateAndUpdateStock($details);
            $sale = Sale::create($data);
            if ($request->filled('details')){
                $this->saleService->registerDetail($sale, $request->array('details'));
            }
           $this->saleService->registerCache($sale);
        });

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
