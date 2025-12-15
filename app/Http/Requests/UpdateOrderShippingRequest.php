<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderShippingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'shipping_address_id' => 'required|exists:shipping_addresses,id',
            'shipping_fee' => 'nullable|numeric|min:0',
            'tracking_number' => 'nullable|string|max:255',
            'delivery_note' => 'nullable|string|max:500',
            'status' => 'required|in:pending,shipping,delivered,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_method_id.required' => 'Please select a shipping method.',
            'shipping_address_id.required' => 'Please select a shipping address.',
            'status.required' => 'The delivery status is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
