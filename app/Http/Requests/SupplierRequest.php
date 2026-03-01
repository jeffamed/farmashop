<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ruc' => ['required'],
            'name' => ['required'],
            'address' => ['nullable'],
            'phone' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
