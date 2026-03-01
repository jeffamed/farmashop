<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers'],
            'user_id' => ['required', 'exists:users'],
            'iva' => ['nullable', 'numeric'],
            'subtotal' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
