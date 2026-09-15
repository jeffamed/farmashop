<?php

namespace App\Http\Controllers;

use App\Http\Requests\KardexRequest;
use App\Http\Resources\KardexResource;
use App\Models\Kardex;

class KardexController extends Controller
{
    public function index()
    {
        return KardexResource::collection(Kardex::all());
    }

    public function store(KardexRequest $request)
    {
        return new KardexResource(Kardex::create($request->validated()));
    }

    public function show(Kardex $kardex)
    {
        return new KardexResource($kardex);
    }

    public function update(KardexRequest $request, Kardex $kardex)
    {
        $kardex->update($request->validated());

        return new KardexResource($kardex);
    }

    public function destroy(Kardex $kardex)
    {
        $kardex->delete();

        return response()->json();
    }
}
