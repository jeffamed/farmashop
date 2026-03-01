<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public OrderService $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $condition = (string) $request->input('condition', '');
        $orders = match ($condition){
            'supplier' => $this->service->getOrderBySupplier($request->toArray()),
            'user' => $this->service->getOrderByUser($request->toArray()),
            default => $this->service->ordersQuery($request->toArray()),
        };

        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $order = Order::create($request->validated());
            $order->details()->createMany($request->array('details'));

            if ($request->has('reimbursement') && $request->integer('reimbursement') > 0) {
                $this->service->storeReimbursement($request->integer('reimbursement'), $order->id);
            }

            return new OrderResource($order);
        });
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json();
    }
}
