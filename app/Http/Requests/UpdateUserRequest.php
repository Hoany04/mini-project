<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Chỉ admin được sửa user
        return auth()->check() && auth()->user()->role->name === 'Admin';
    }

    public function rules(): array
    {
        $id = $this->route('user'); // Lấy id từ route model hoặc param

        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|string|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Tên đăng nhập bắt buộc nhập',
            'email.required' => 'Email bắt buộc nhập',
            'email.unique' => 'Email đã tồn tại',
            'role_id.required' => 'Phải chọn vai trò người dùng',
            'status.required' => 'Phải chọn trạng thái hoạt động',
        ];
    }
}
