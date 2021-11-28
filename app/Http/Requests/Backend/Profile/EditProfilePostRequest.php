<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilePostRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->guard('admin')->id(),
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6|same:password',
        ];
    }
}
