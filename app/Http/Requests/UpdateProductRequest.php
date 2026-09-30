<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => [
                'nullable',
                Rule::unique('products', 'code')->ignore($this->route('product')),
            ],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'cost' => ['nullable', 'numeric'],
            'stock' => ['required', 'integer'],
            'discount' => ['nullable', 'numeric'],
            'unit_box' => ['required', 'numeric', 'min:1'],
            'box_stock' => ['nullable', 'numeric'],
            'expired_at' => ['nullable', 'date'],
            'laboratory_id' => ['required', 'exists:laboratories,id',],
            'type_id' => ['required', 'exists:types,id',],
            'location_id' => ['required', 'exists:locations,id',],
            'supplier_id' => ['required', 'exists:suppliers,id',],
            'presentation_id' => ['required', 'exists:presentations,id',],
            'usages' => ['nullable', 'array'],
            'usages.*' => ['integer', 'exists:usages,id',],
        ];
    }

    public function authorize(): bool
    {
        return Gate::allows('product.update');
    }
}
