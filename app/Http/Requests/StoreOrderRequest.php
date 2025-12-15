<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép user thực hiện request này
    }

    public function rules(): array
    {
        return [
            'paymentmethod' => 'required|string',
            'shipping_address_id' => 'required|integer|exists:shipping_addresses,id',
            'shipping_method_id' => 'required|integer|exists:shipping_methods,id',
            'delivery_note' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'paymentmethod.required' => 'Please select a payment method.',
            'shipping_address_id.required' => 'Please select a shipping address.',
            'shipping_address_id.exists' => 'The selected shipping address is invalid.',
            'shipping_method_id.required' => 'Please select a shipping method.',
            'shipping_method_id.exists' => 'The selected shipping method does not exist.',
            'delivery_note.max' => 'The note must not exceed 255 characters.',

        ];
    }
}
