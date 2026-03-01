<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers'],
            'user_id' => ['required', 'exists:users'],
            'iva' => ['nullable', 'numeric'],
            'subtotal' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.product_id' => ['required', 'exists:products'],
            'details.*.quantity' => ['required', 'integer', 'min:1'],
            'details.*.price' => ['required', 'numeric', 'min:0'],
            'reimbursement' => ['nullable', 'integer', 'exists:reimbursements,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
