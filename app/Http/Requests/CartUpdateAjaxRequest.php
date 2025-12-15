<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateAjaxRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => 'required|integer|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'item_id.required' => 'No products were found in the cart.',
            'item_id.exists' => 'The product in the cart does not exist.',
            'quantity.required' => 'Please enter the quantity.',
            'quantity.min' => 'The number must be greater than 0.',
        ];
    }
}
