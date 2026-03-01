<?php

namespace App\Http\Requests;

use App\Enums\StatusesReimbursement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ReimbursementRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers'],
            'order_id' => ['required', 'exists:orders'],
            'total' => ['required', 'numeric'],
            'observation' => ['nullable'],
            'status' => ['required', new Enum(StatusesReimbursement::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
