<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // cho phép mọi admin dùng request này
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Order status is required.',
        ];
    }
}
