<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsageRequest;
use App\Http\Resources\UsageResource;
use App\Models\Usage;

class UsageController extends Controller
{
    public function index()
    {
        return UsageResource::collection(Usage::all());
    }

    public function store(UsageRequest $request)
    {
        return new UsageResource(Usage::create($request->validated()));
    }

    public function show(Usage $usage)
    {
        return new UsageResource($usage);
    }

    public function update(UsageRequest $request, Usage $usage)
    {
        $usage->update($request->validated());

        return new UsageResource($usage);
    }

    public function destroy(Usage $usage)
    {
        $usage->delete();

        return response()->json();
    }
}
