<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use VVinners\Vapi\Api;

class ApiRequest extends FormRequest
{
    // override and return json error message
    protected function failedValidation(Validator $validator)
    {
        $api = new Api();
        throw new HttpResponseException(
            $api->response(['error' => $validator->errors()->all(), 'data' => []], 'VALIDATION_ERROR')
        );
    }
}
