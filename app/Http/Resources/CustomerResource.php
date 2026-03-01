<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Customer */
class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $type = (string) $request->input('type');

        if ($type === 'limit'){
            return $this->basicLocalization();
        }

        return [
            'id' => $this->id,
            'dni' => $this->dni,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function basicLocalization(): array
    {
        return [
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
