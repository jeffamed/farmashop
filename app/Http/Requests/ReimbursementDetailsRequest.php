<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReimbursementDetailsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reimbursement_id' => ['required', 'exists:reimbursements'],
            'product_id' => ['required', 'exists:products'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
