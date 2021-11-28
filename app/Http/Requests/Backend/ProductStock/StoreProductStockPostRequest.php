<?php

namespace App\Http\Requests\Backend\ProductStock;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductStockPostRequest extends FormRequest
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
            'product_category' => 'required',
            'sub_category' => 'required',
            'product' => 'required'
        ];
    }
}
