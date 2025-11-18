<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'variant_name'  => 'required|string|max:100',
            'variant_value' => 'required|string|max:100',
            'extra_price'   => 'nullable|numeric|min:0',
            'stock'         => 'required|integer|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'variant_name.required'  => 'Ten bien the khong duoc de trong',
            'variant_value.required' => 'Gia tri bien the khong duoc de trong',
            'stock.required'         => 'So luong bien the khong duoc de trong',
        ];
    }
}
