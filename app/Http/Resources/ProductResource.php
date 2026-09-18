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
            'unit_price' => $this->price,
            'stock' => $this->stock,
            $this->mergeWhen($request->routeIs('products.index'), fn() => $this->mergeIndex()),
            $this->mergeWhen($request->routeIs('products.show'), fn() =>$this->mergeShow()),
        ];
    }

    private function mergeIndex(): array
    {
        return [
            'laboratory' => $this->whenLoaded('laboratory')->name ?? '',
            'type' => $this->whenLoaded('type')->name ?? '',
        ];
    }

    private function mergeShow(): array
    {
        return [
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
            'image' => $this->whenLoaded('media', fn () => $this->getFirstMediaUrl('images-product', 'thumb')),
            /*'laboratory' => $this->whenLoaded('laboratory', fn() => $this->laboratory->name),
            'type' => $this->whenLoaded('type', fn() => $this->type->name),
            'location' => $this->whenLoaded('location', fn() => $this->location->name),
            'supplier' => $this->whenLoaded('supplier', fn() => $this->supplier->name),
            'presentation' => $this->whenLoaded('presentation', fn() => $this->presentation->name),
            'usagesId' => $this->whenLoaded('usages', fn() => $this->usages->pluck('id')->toArray()),*/
        ];
    }
}
