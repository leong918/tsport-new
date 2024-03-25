<?php

namespace App\Http\Requests\Form\TopBar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopBarRequest extends FormRequest
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
            'title' => 'required',
            'font_size' => 'required',
            'background_colour' => 'required',
            'font_colour' => 'required',
            'status' => 'required',
        ];
    }
}
