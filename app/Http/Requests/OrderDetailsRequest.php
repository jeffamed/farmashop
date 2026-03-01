<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_id' => ['required', 'exists:orders'],
            'product_id' => ['required', 'exists:products'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
            'suggest_price' => ['required', 'numeric'],
            'expire_at' => ['nullable', 'date'],
            'total' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
