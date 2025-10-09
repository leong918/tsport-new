<?php

namespace App\Http\Requests\Form\Web;

use Illuminate\Foundation\Http\FormRequest;

class WebRegisterRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:50|unique:user,username|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required|string|min:6|max:255',
            'phone_no' => 'required|string|max:20',
            'phone_region' => 'nullable|string|max:10',
            'email' => 'required|email|max:255|unique:user,email',
            'referral_code' => 'nullable|string|max:50',
            'verification_code' => 'nullable|string|max:10',
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
            'username.min' => '用户名至少需要3个字符',
            'username.max' => '用户名不能超过50个字符',
            'username.unique' => '该用户名已被使用',
            'username.regex' => '用户名只能包含字母、数字和下划线',
            'password.required' => '密码是必填项',
            'password.min' => '密码至少需要6个字符',
            'phone_no.required' => '电话号码是必填项',
            'email.required' => '邮箱是必填项',
            'email.email' => '请输入有效的邮箱地址',
            'email.unique' => '该邮箱已被注册',
        ];
    }
}
