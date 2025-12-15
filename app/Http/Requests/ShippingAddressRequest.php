<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Chỉ cho phép người dùng đã đăng nhập
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:15',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'address_detail' => 'required|string|max:255',
            'is_default' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter the recipient\'s full name.',
            'phone.required' => 'Please enter a phone number.',
            'province.required' => 'Please select a province/city.',
            'district.required' => 'Please select a district.',
            'ward.required' => 'Please select a ward.',
            'address_detail.required' => 'Please enter the detailed address.',
            'phone.max' => 'The phone number must not exceed 15 characters.',
            'address_detail.max' => 'The address must not exceed 255 characters.',
        ];
    }
}
