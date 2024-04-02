<?php

namespace App\Http\Requests\Form\TopBar;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopBarRequest extends FormRequest
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
            'name' => 'required',
            'background_colour' => 'required',
            'status' => 'required',
            'content' => 'required',
        ];
    }
}
