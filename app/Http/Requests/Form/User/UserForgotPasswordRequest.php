<?php

namespace App\Http\Requests\Form\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserForgotPasswordRequest extends FormRequest
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
            'email' => 'required'
        ];
    }

    // Returning errors as exception
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'msg' => $validator->errors(),
            ], 500)
        );
    }
}
