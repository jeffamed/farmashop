<?php

namespace App\Services;

use App\Actions\CalculateTotal;
use App\Enums\StatusesReimbursement;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Reimbursement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct()
    {}

    public function ordersQuery(array $params = []): Builder
    {
        return Order::query()
            ->with('user', 'supplier')
            ->latest('id')
            ->when($params['pagination'],
                fn($query) => $query->paginate($params['pagination']));
    }

    public function getOrderByUser(array $params): Collection|LengthAwarePaginator
    {
        $search = "{$params['search']}";
        $users = User::searchByName($search)->select('id')->pluck('id');
        return $this->ordersQuery()
            ->whereIn('user_id', $users)
            ->paginate($params['pagination']);
    }

    public function getOrderBySupplier(array $params): Collection|LengthAwarePaginator
    {
        $search = "{$params['search']}";
        $suppliers = Supplier::searchByName($search)->select('id')->pluck('id');
        return $this->ordersQuery()
            ->whereIn('supplier_id', $suppliers)
            ->paginate($params['pagination']);
    }

    public function storeReimbursement(int $reimbursementId, int $orderId): Collection
    {
        $reimbursement = Reimbursement::findOrFail($reimbursementId);
        $reimbursement->status = StatusesReimbursement::APPROVED;
        $reimbursement->observation = $reimbursement->observation ? $reimbursement->observation . ' (*) Aplicado en la fecha '.now()->format('d-m-Y H:i:s').' a la compra con # '.$orderId : ' (*) Aplicado en la fecha '.now()->format('d-m-Y H:i:s').' a la compra con # '.$orderId;
        $reimbursement->order()->associate($orderId);
        $reimbursement->save();
        return $reimbursement;
        //TODO: Enviar notificación al usuario, Registrar en tabla de historial, Enviar email, Notificar a contabilidad, Registrar auditoría, Enviar webhook, Disparar un Job
    }

    public function registerDetail(Order $order, array $details): void
    {
        $now = now();
        $data = collect($details)->map(fn($detail) => [
            'order_id' => $order->id,
            'product_id' => $detail['product_id'],
            'quantity' => $detail['quantity'],
            'unit_price' => $detail['unit_price'],
            'discount' => $detail['discount'],
            'total' => CalculateTotal::handle($detail),
            'created_at' => $now,
            'updated_at' => $now,
        ])->toArray();

        OrderDetails::insert($data);
    }

}
