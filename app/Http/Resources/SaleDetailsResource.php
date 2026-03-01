<?php

namespace App\Http\Resources;

use App\Models\SaleDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SaleDetails */
class SaleDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,

            'sale' => new SaleResource($this->whenLoaded('sale')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
