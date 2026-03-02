<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReimbursementRequest;
use App\Http\Resources\ReimbursementResource;
use App\Models\Reimbursement;
use App\Services\ReimbursementService;
use Illuminate\Http\Request;

class ReimbursementController extends Controller
{
    public ReimbursementService $service;
    public function __construct()
    {
        $this->service = new ReimbursementService();
    }
    public function index(Request $request)
    {
        $reimbursements = Reimbursement::latest('id')
            ->when($request->input('search', ''), function ($q, $name) {
                $q->whereHas('supplier', function ($q) use ($name) {
                    $q->where('name', 'like', "%{$name}%");
                });
            })
            ->paginate($request->integer('pagination', 10));
        return ReimbursementResource::collection(Reimbursement::all());
    }

    public function store(ReimbursementRequest $request)
    {
        return \DB::transaction(function() use ($request){
            $reimbursement = Reimbursement::create($request->validated());
            if ($request->filled('products')){
                $this->service->registerDetails($reimbursement, $request->array('products'));
            }
            return new ReimbursementResource($reimbursement->load('details.product'));
        });
    }

    public function show(Reimbursement $reimbursement)
    {
        return new ReimbursementResource($reimbursement);
    }

    public function update(ReimbursementRequest $request, Reimbursement $reimbursement)
    {
        $reimbursement->update($request->validated());

        return new ReimbursementResource($reimbursement);
    }

    public function destroy(Reimbursement $reimbursement)
    {
        $reimbursement->delete();

        return response()->json();
    }
}
