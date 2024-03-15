<?php

namespace App\Http\Requests\Form\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRegisterRequest extends FormRequest
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
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'email' => 'required|unique:user',
            'phone_no' => 'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'birth_month' => 'required',
            'accept_tnc' => 'required',
            'referral_email' => 'both_or_none:referral_phone_no',
            'referral_phone_no' => 'both_or_none:referral_email',
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
            'referral_email.both_or_none' => 'Either both Referral Email and Referral Phone No must be filled or both must be empty.',
            'referral_phone_no.both_or_none' => 'Either both Referral Email and Referral Phone No must be filled or both must be empty.',
        ];
    }
}
