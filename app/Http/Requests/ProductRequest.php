<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'discount' => ['nullable', 'numeric'],
            'unit_box' => ['required', 'numeric'],
            'box_stock' => ['required', 'numeric'],
            'expired_at' => ['nullable', 'date'],
            'laboratory_id' => ['required', 'exists:laboratories,id'],
            'type_id' => ['required', 'exists:types,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'presentation_id' => ['required', 'exists:presentations,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
