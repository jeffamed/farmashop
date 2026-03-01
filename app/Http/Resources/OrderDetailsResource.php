<?php

namespace App\Http\Resources;

use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderDetails */
class OrderDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'suggest_price' => $this->suggest_price,
            'expire_at' => $this->expire_at,
            'total' => $this->total,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'order_id' => $this->order_id,
            'product_id' => $this->product_id,

            'order' => new OrderResource($this->whenLoaded('order')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
