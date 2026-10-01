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
        /*$condition = (string) $request->input('condition', '');
        $orders = match ($condition){
            'supplier' => $this->service->getOrderBySupplier($request->toArray()),
            'user' => $this->service->getOrderByUser($request->toArray()),
            default => $this->service->ordersQuery($request->toArray()),
        };*/
        $orders = Order::with('supplier', 'user', 'details.product', 'reimbursement')
            ->latest('id')
            ->select('id', 'number_order', 'iva', 'subtotal', 'total', 'discount', 'supplier_id', 'user_id', 'total', 'created_at', 'updated_at')
            ->paginate(perPage: $request->integer('pagination', 10), page: $request->integer('page', 1));

        return OrderResource::collection($orders);
    }

    /**
     * @throws \Throwable
     */
    public function store(OrderRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $order = Order::create($request->validated());
            if ($request->filled('details')){
                $this->service->registerDetail($order, $request->array('details'));
            }

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
