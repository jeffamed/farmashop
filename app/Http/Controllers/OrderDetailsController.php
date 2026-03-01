<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetailsRequest;
use App\Http\Resources\OrderDetailsResource;
use App\Models\OrderDetails;

class OrderDetailsController extends Controller
{
    public function index()
    {
        return OrderDetailsResource::collection(OrderDetails::all());
    }

    public function store(OrderDetailsRequest $request)
    {
        return new OrderDetailsResource(OrderDetails::create($request->validated()));
    }

    public function show(OrderDetails $orderDetails)
    {
        return new OrderDetailsResource($orderDetails);
    }

    public function update(OrderDetailsRequest $request, OrderDetails $orderDetails)
    {
        $orderDetails->update($request->validated());

        return new OrderDetailsResource($orderDetails);
    }

    public function destroy(OrderDetails $orderDetails)
    {
        $orderDetails->delete();

        return response()->json();
    }
}
