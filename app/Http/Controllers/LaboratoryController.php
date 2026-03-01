<?php

namespace App\Http\Controllers;

use App\Dtos\LaboratoryFilter;
use App\Http\Requests\LaboratoryRequest;
use App\Http\Resources\LaboratoryResource;
use App\Models\Laboratory;
use App\Services\LaboratoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    protected LaboratoryService $service;

    public function __construct()
    {
        $this->service = new LaboratoryService();
    }

    public function index(Request $request)
    {
        $data = new LaboratoryFilter(
            search: (string) $request->input('search', ''),
            pagination: $request->integer('pagination', 10),
            needPagination: $request->boolean('needPagination', true)
        );

        $laboratories = $this->service->getLaboratories($data);

        return LaboratoryResource::collection($laboratories);
    }

    public function store(LaboratoryRequest $request)
    {
        return new LaboratoryResource(Laboratory::create($request->validated()));
    }

    public function show(Laboratory $laboratory)
    {
        return new LaboratoryResource($laboratory);
    }

    public function update(LaboratoryRequest $request, Laboratory $laboratory)
    {
        $laboratory->update($request->validated());

        return new LaboratoryResource($laboratory);
    }

    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return response()->json();
    }
}
