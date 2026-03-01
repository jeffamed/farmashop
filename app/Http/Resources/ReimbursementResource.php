<?php

namespace App\Http\Resources;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Reimbursement */
class ReimbursementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'observation' => $this->observation,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'supplier_id' => $this->supplier_id,
            'order_id' => $this->order_id,

            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'order' => new OrderResource($this->whenLoaded('order')),
        ];
    }
}
