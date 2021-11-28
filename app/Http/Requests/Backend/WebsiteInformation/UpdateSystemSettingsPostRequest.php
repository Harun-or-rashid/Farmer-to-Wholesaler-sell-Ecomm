<?php

namespace App\Http\Requests\Backend\WebsiteInformation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemSettingsPostRequest extends FormRequest
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
            'website_title' => 'required',
            'website_short_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'logo' => 'nullable',
            'favicon' => 'nullable',
        ];
    }
}
