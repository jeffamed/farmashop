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
            'cost' => $this->whenLoaded('lastOrderDetails', fn() => $this->cost),
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->whenLoaded('type')->name ?? '',
            'laboratory' => $this->whenLoaded('laboratory', function() {
                return [
                    'name' => $this->laboratory->name ?? '',
                    'address' => $this->laboratory->address ?? '',
                ];
            }),
            'location' => $this->whenLoaded('location')->name ?? '',
            'supplier' => $this->whenLoaded('supplier', function() {
                return [
                    'ruc' => $this->supplier->ruc ?? '',
                    'name' => $this->supplier->name ?? '',
                    'address' => $this->supplier->address ?? '',
                    'telephone' => $this->supplier->phone ? $this->supplier->phone['number']: '',
                ];
            }),
            'usages' => $this->whenLoaded('usages', fn() => $this->usages->map(fn($usage) => $usage->description)),
            'presentation' => $this->whenLoaded('presentation')->name ?? '',
            'image' =>  $this->whenLoaded('media', fn () => $this->getFirstMediaUrl('images-product', 'preview'))
        ];
    }
}
