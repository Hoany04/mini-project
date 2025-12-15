<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'items'   => 'required|array|min:1',

            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'items.*.product_id.exists' => 'The product does not exist.',
            'items.*.quantity.min'      => 'The number must be greater than 0.',
        ];
    }
}
