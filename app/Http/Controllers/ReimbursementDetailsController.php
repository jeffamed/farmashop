<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReimbursementDetailsRequest;
use App\Http\Resources\ReimbursementDetailsResource;
use App\Models\ReimbursementDetails;

class ReimbursementDetailsController extends Controller
{
    public function index()
    {
        return ReimbursementDetailsResource::collection(ReimbursementDetails::all());
    }

    public function store(ReimbursementDetailsRequest $request)
    {
        return new ReimbursementDetailsResource(ReimbursementDetails::create($request->validated()));
    }

    public function show(ReimbursementDetails $reimbursementDetails)
    {
        return new ReimbursementDetailsResource($reimbursementDetails);
    }

    public function update(ReimbursementDetailsRequest $request, ReimbursementDetails $reimbursementDetails)
    {
        $reimbursementDetails->update($request->validated());

        return new ReimbursementDetailsResource($reimbursementDetails);
    }

    public function destroy(ReimbursementDetails $reimbursementDetails)
    {
        $reimbursementDetails->delete();

        return response()->json();
    }
}
