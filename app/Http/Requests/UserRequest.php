<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'document' => ['required'],
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required'],
            'phone' => ['nullable'],
            'address' => ['nullable','string'],
            'remember_token' => ['nullable'],
            'deleted_at' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
