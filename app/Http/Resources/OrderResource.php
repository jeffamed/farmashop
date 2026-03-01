<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_order' => $this->number_order,
            'iva' => $this->iva,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'supplier_id' => $this->supplier_id,
            'user_id' => $this->user_id,

            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
        ];
    }
}
