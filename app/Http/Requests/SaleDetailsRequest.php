<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleDetailsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sale_id' => ['required', 'exists:sales'],
            'product_id' => ['required', 'exists:products'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
