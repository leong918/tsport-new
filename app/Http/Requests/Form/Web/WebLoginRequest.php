<?php

namespace App\Http\Requests\Form\Web;

use Illuminate\Foundation\Http\FormRequest;

class WebLoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Get custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '用户名是必填项',
            'password.required' => '密码是必填项',
        ];
    }
}
