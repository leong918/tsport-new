<?php

namespace App\Http\Requests\Form\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class UpdateProductRequest extends FormRequest
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'alias' => ['required',Rule::unique('product')->ignore($this->id),'regex:/^[\w\p{Han}\-]+$/u'],
            'sku' => ['required',Rule::unique('product')->ignore($this->id)],
            'status' => 'required',
            'sort' => 'required',
            'is_best_seller' => 'required',
            'is_new' => 'required',
        ];
    }

    // Returning errors as exception
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'msg' => $validator->errors()->first(),
            ], 500)
        );
    }
}
