<?php

namespace App\Http\Controllers;

use App\Http\Requests\locationRequest;
use App\Http\Requests\OptionResource;
use App\Http\Resources\locationResource;
use App\Models\location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::latest('id')
            ->when($request->search, fn($q, $name) => $q->searchByName(name: $name))
            ->when($request->needPagination,
                fn($query) => $query->paginate($request->integer('pagination', 10)),
                fn($query) => $query->when($request->integer('limit'), fn(Builder $query) => $query->limit($request->integer('limit')))->get());

        if ($request->input('view') === 'options') {
            return OptionResource::collection($locations);
        }

        return $locations->toResourceCollection();
    }

    public function store(locationRequest $request)
    {
        return new locationResource(location::create($request->validated()));
    }

    public function show(location $location)
    {
        return new locationResource($location);
    }

    public function update(locationRequest $request, location $location)
    {
        $location->update($request->validated());

        return new locationResource($location);
    }

    public function destroy(location $location)
    {
        $location->delete();

        return response()->json();
    }
}
