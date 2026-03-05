<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public TypeService $service;

    public function __construct()
    {
        $this->service = new TypeService();
    }

    public function index(Request $request)
    {
        $types = $this->service->getTypes($request->toArray());
        return TypeResource::collection($types);
    }

    public function store(TypeRequest $request)
    {
        return new TypeResource(Type::create($request->validated()));
    }

    public function show(Type $type)
    {
        return new TypeResource($type);
    }

    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->validated());

        return new TypeResource($type);
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return response()->json();
    }
}
