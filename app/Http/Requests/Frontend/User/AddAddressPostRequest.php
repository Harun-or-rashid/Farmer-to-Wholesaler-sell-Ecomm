<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;

class AddAddressPostRequest extends FormRequest
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
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'post_code' => 'required',
            'address' => 'required',
            'full_name' => 'required',
            'phone_number' => 'required',
        ];
    }
}
