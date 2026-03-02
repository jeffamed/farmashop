<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'discount' => $this->discount,
            'box_stock' => $this->box_stock,
            'unit_box' => $this->unit_box,
            'cost' => $this->cost,
            'costPrev' => $this->costPrev,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'laboratory_id' => $this->laboratory_id,
            'type_id' => $this->type_id,
            'location_id' => $this->location_id,
            'supplier_id' => $this->supplier_id,
            'presentation_id' => $this->presentation_id,

            $this->mergeWhen($request->routeIs('products.index'), $this->mergeIndex()),
            $this->mergeWhen($request->routeIs('products.show'), $this->mergeShow()),
        ];
    }

    private function mergeIndex(): array
    {
        return [
            'laboratory' => new LaboratoryResource($this->whenLoaded('laboratory')),
            'type' => new TypeResource($this->whenLoaded('type')),
            'location' => new locationResource($this->whenLoaded('location')),
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'presentation' => new PresentationResource($this->whenLoaded('presentation')),
        ];
    }

    private function mergeShow(): array
    {
        return [
            'laboratory' => $this->whenLoaded('laboratory', fn() => $this->laboratory->name),
            'type' => $this->whenLoaded('type', fn() => $this->type->name),
            'location' => $this->whenLoaded('location', fn() => $this->location->name),
            'supplier' => $this->whenLoaded('supplier', fn() => $this->supplier->name),
            'presentation' => $this->whenLoaded('presentation', fn() => $this->presentation->name),
            'usagesId' => $this->whenLoaded('usages', fn() => $this->usages->pluck('id')->toArray()),
        ];
    }
}
