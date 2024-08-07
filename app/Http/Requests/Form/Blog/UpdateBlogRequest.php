<?php

namespace App\Http\Requests\Form\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateBlogRequest extends FormRequest
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
            'blog_category_name' => 'required',
            'image' => 'nullable|max:1024',
            'status' => 'required',
            'sort' => 'required',
            'language.en.name' => 'required',
            'language.tc.name' => 'required',
            'language.sc.name' => 'required',
            'language.en.content' => 'required',
            'language.tc.content' => 'required',
            'language.sc.content' => 'required',
        ];
    }
}
