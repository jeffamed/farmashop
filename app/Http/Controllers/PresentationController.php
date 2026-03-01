<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentationRequest;
use App\Http\Resources\PresentationResource;
use App\Models\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index(Request $request)
    {
        $presentations = Presentation::latest('id')
            ->when($request->search, fn($q, $name) => $q->searchByName(name: $name))
            ->when($request->needPagination,
                fn($query) => $query->paginate($request->integer('pagination', 10)),
                fn($query) => $query->get());

        return PresentationResource::collection($presentations);
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
