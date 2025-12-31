<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
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
            'username.required' => 'Please enter a username.',
            'email.required' => 'Please enter an email address.',
            'email.unique' => 'This email already exists in the system.',
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'The password confirmation does not match.',
            'role_id.required' => 'Please select a role.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
