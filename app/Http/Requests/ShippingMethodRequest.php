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
            'name.required' => 'Tên phương thức không được để trống',
            'fee.required' => 'Phí vận chuyển là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
        ];
    }
}
