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
            'full_name.required' => 'Vui lòng nhập họ và tên người nhận.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
            'district.required' => 'Vui lòng chọn quận/huyện.',
            'ward.required' => 'Vui lòng chọn phường/xã.',
            'address_detail.required' => 'Vui lòng nhập địa chỉ chi tiết.',
            'phone.max' => 'Số điện thoại không vượt quá 15 ký tự.',
            'address_detail.max' => 'Địa chỉ không vượt quá 255 ký tự.',
        ];
    }
}
