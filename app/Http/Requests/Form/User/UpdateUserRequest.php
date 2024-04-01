<?php

namespace App\Http\Requests\Form\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', Rule::unique('user')->ignore($this->id)],
            'phone_no' => ['required', Rule::unique('user')->ignore($this->id)],
            'dob' => 'required|date_format:d/m/Y',
            'referral_email' => 'both_or_none:referral_phone_no',
            'referral_phone_no' => 'both_or_none:referral_email',
        ];
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
