<?php

namespace App\Http\Requests\Form\Web;

use Illuminate\Foundation\Http\FormRequest;

class WebResetPasswordRequest extends FormRequest
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
        $rules = [
            'password' => 'required|string|min:8|max:255|confirmed|regex:/^\S*$/',
            'password_confirmation' => 'required|string|min:8|max:255',
        ];

        // Add current password validation only for authenticated users
        if (auth('user')->check()) {
            $rules['current_password'] = 'required|string';
        }

        return $rules;
    }

    /**
     * Get custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.required' => '当前密码是必填项',
            'password.required' => '新密码是必填项',
            'password.min' => '新密码至少需要8个字符',
            'password.max' => '新密码不能超过255个字符',
            'password.confirmed' => '密码确认不匹配',
            'password.regex' => '新密码不能包含空格',
            'password_confirmation.required' => '确认密码是必填项',
            'password_confirmation.min' => '确认密码至少需要8个字符',
            'password_confirmation.max' => '确认密码不能超过255个字符',
        ];
    }
}
