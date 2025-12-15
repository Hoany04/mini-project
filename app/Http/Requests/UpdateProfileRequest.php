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
            'phone.required' => 'The phone number is required.',
            'phone.max' => 'The phone number must not exceed 15 characters.',
            'address.max' => 'The address must not exceed 255 characters.',
            'city.max' => 'The city name must not exceed 100 characters.',
            'country.max' => 'The country name must not exceed 100 characters.',
            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif, webp.',
            'avatar.max' => 'The avatar must not exceed 2MB.',
        ];
    }
}
