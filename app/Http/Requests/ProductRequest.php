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
            'box_stock' => ['required', 'numeric'],
            'expired_at' => ['nullable', 'date'],
            'laboratory_id' => ['required', 'exists:laboratories'],
            'type_id' => ['required', 'exists:types'],
            'location_id' => ['required', 'exists:locations'],
            'supplier_id' => ['required', 'exists:suppliers'],
            'presentation_id' => ['required', 'exists:presentations'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
