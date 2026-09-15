<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KardexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products'],
            'product_id' => ['required', 'exists:products'],
            'type' => ['required'],
            'quantity' => ['required', 'integer'],
            'stock_before' => ['required', 'integer'],
            'stock_after' => ['required', 'integer'],
            'created_by' => ['nullable', 'integer'],
            'user_id' => ['required', 'exists:users'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
