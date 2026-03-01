<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaboratoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'address' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
