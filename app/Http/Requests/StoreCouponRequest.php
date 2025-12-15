<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:0',
            'status' => 'required|in:active,expired,inactive',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'The discount code is required.',
            'code.string' => 'The discount code must be a string.',
            'code.max' => 'The discount code must not exceed 50 characters.',
            'code.unique' => 'This discount code already exists.',

            'description.string' => 'The description must be a string.',

            'discount_type.required' => 'The discount type is required.',
            'discount_type.in' => 'The discount type must be either "percent" or "fixed".',

            'discount_value.required' => 'The discount value is required.',
            'discount_value.numeric' => 'The discount value must be a number.',
            'discount_value.min' => 'The discount value must not be less than 0.',

            'min_order_value.numeric' => 'The minimum order value must be a number.',
            'min_order_value.min' => 'The minimum order value must not be less than 0.',

            'max_discount.numeric' => 'The maximum discount value must be a number.',
            'max_discount.min' => 'The maximum discount value must not be less than 0.',

            'start_date.date' => 'The start date must be a valid date.',

            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',

            'usage_limit.integer' => 'The usage limit must be an integer.',
            'usage_limit.min' => 'The usage limit must not be less than 0.',

            'status.required' => 'The status is required.',
            'status.in' => 'The status must be one of the following: active, expired, or inactive.',
        ];
    }
}
