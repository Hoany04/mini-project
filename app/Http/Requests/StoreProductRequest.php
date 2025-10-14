<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role->name === 'Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|in:active, inactive,out_of_stock',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ten san pham khong duoc vuot qua 255 ki tu',
            'price.required' => 'Gia san pham bat buoc nhap',
            'stock.required' => 'So luong ton bat buoc nhap',
        ];
    }
}
