<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReimbursementRequest;
use App\Http\Resources\ReimbursementResource;
use App\Models\Reimbursement;

class ReimbursementController extends Controller
{
    public function index()
    {
        return ReimbursementResource::collection(Reimbursement::all());
    }

    public function store(ReimbursementRequest $request)
    {
        return new ReimbursementResource(Reimbursement::create($request->validated()));
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
