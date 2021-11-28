<?php

namespace App\Http\Requests\Backend\ProductColor;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductColorPostRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|unique:product_colors,title'
        ];
    }
}
