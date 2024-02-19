<?php

namespace App\Http\Requests\Form\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'dob' => 'required',
            'password' => 'required',
            'referral_email' => 'required',
            'referral_phone_no' => 'required',
        ];
    }
}
