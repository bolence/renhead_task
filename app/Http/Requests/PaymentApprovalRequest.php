<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentApprovalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'payment_type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'payment_id.required' => 'Missing payment id is missing',
            'user_id.required' => 'Missing user id is missing',
            'status.required' => 'Status is required',
            'payment_type.required' => 'Payment type is required',
        ];
    }
}
