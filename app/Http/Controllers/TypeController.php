<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        return TypeResource::collection(Type::all());
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
