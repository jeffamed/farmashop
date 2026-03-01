<?php

namespace App\Http\Resources;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Sale */
class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'iva' => $this->iva,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,

            'customer' => new CustomerResource($this->whenLoaded('customer')),
        ];
    }
}
