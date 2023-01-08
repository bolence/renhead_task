<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TravelPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'amount' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Missing user_id',
            'amount.required' => 'Amount is required field',
            'amount.integer' => 'Amount needs to be integer',
        ];
    }
}
