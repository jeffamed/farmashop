<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsageRequest;
use App\Http\Resources\UsageResource;
use App\Models\Usage;
use App\Services\UsageService;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public UsageService $service;
    public function __construct()
    {
        $this->service = new UsageService();
    }

    public function index(Request $request)
    {
        $usages = $this->service->getUsages($request->toArray());
        return UsageResource::collection($usages);
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
