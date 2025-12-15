<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // có thể kiểm tra quyền admin ở đây
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The method name is required.',
            'fee.required' => 'The shipping fee is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
