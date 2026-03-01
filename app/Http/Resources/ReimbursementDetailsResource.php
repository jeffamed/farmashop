<?php

namespace App\Http\Resources;

use App\Models\ReimbursementDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ReimbursementDetails */
class ReimbursementDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,

            'reimbursement_id' => $this->reimbursement_id,
            'product_id' => $this->product_id,

            'reimbursement' => new ReimbursementResource($this->whenLoaded('reimbursement')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
