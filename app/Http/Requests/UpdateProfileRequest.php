<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cho phép tất cả user đã đăng nhập cập nhật hồ sơ của chính họ
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'city.max' => 'Tên thành phố không được vượt quá 100 ký tự.',
            'country.max' => 'Tên quốc gia không được vượt quá 100 ký tự.',
            'avatar.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện chỉ chấp nhận các định dạng jpeg, png, jpg, gif, webp.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB.',
        ];
    }
}
