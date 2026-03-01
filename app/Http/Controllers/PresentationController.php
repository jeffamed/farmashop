<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentationRequest;
use App\Http\Resources\PresentationResource;
use App\Models\Presentation;

class PresentationController extends Controller
{
    public function index()
    {
        return PresentationResource::collection(Presentation::all());
    }

    public function store(PresentationRequest $request)
    {
        return new PresentationResource(Presentation::create($request->validated()));
    }

    public function show(Presentation $presentation)
    {
        return new PresentationResource($presentation);
    }

    public function update(PresentationRequest $request, Presentation $presentation)
    {
        $presentation->update($request->validated());

        return new PresentationResource($presentation);
    }

    public function destroy(Presentation $presentation)
    {
        $presentation->delete();

        return response()->json();
    }
}
