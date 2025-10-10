<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Chỉ admin mới được thêm user
        return auth()->check() && auth()->user()->role->name === 'Admin';
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|string|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'role_id.required' => 'Vui lòng chọn vai trò',
            'status.in' => 'Trạng thái không hợp lệ',
        ];
    }
}
