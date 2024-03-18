<?php

namespace App\Http\Requests\Form\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserUpdateInfoRequest extends FormRequest
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
        $rules =  [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'birth_month' => 'required',
            'current_password' => 'both_or_none:password',
            'password' => 'both_or_none:current_password',
        ];

        // If both current_password and password are provided, apply min:6 rule for both
        if ($this->filled('current_password') && $this->filled('password')) {
            $rules['current_password'] .= '|min:6';
            $rules['password'] .= '|min:6|confirmed';
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'msg' => $validator->errors(),
            ], 500)
        );
    }


    public function withValidator($validator)
    {
        $validator->addExtension('both_or_none', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            $data = $validator->getData();
    
            // Check if either both fields are filled or both are empty
            $fieldA = $data[$attribute];    
            $fieldB = $data[$otherField];
    
            // Check if there's already an error message for one of the fields
            if ($validator->errors()->has($attribute) || $validator->errors()->has($otherField)) {
                return true;
            }
    
            if ((empty($fieldA) && !empty($fieldB)) || (!empty($fieldA) && empty($fieldB))) {
                return false;
            }
    
            return true;
        });
    }
    
    public function messages()
    {
        return [
            'current_password.both_or_none' => 'Either both Current Password and New Password must be filled or both must be empty.',
            'password.both_or_none' => 'Either both Current Password and New Password must be filled or both must be empty.',
        ];
    }

}
