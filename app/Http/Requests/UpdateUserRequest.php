<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('id'); // Lấy id từ route model hoặc param

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
            'username.required' => 'The username is required.',
            'email.required' => 'The email address is required.',
            'email.unique' => 'This email already exists.',
            'role_id.required' => 'Please select a user role.',
            'status.required' => 'Please select an active status.',
        ];
    }
}
