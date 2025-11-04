<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }
}
?>