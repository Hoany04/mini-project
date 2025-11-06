<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép user thực hiện request này
    }

    public function rules(): array
    {
        return [
            'paymentmethod' => 'required|string',
            'shipping_address_id' => 'required|integer|exists:shipping_addresses,id',
            'shipping_method_id' => 'required|integer|exists:shipping_methods,id',
            'delivery_note' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'paymentmethod.required' => 'Vui lòng chọn phương thức thanh toán.',
            'shipping_address_id.required' => 'Vui lòng chọn địa chỉ giao hàng.',
            'shipping_address_id.exists' => 'Địa chỉ giao hàng không hợp lệ.',
            'shipping_method_id.required' => 'Vui lòng chọn phương thức vận chuyển.',
            'shipping_method_id.exists' => 'Phương thức vận chuyển không tồn tại.',
            'delivery_note.max' => 'Ghi chú không được vượt quá 255 ký tự.',
        ];
    }
}
