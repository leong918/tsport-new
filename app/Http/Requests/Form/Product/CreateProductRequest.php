<?php

namespace App\Http\Requests\Form\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'sku' => 'required',
            'status' => 'required',
            'sort' => 'required',
            'is_best_seller' => 'required',
            'is_new' => 'required',
            // 'product_price' => 'required',
        ];
    }
}
