<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
