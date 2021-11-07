<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\moderator;
use App\Models\User;

class modRegistrationRequest extends FormRequest
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
            'fullName'  => 'required|min:3',
            'uname'     => 'required|min:5|unique:users',
            'password'  => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'cpassword' => 'required|same:password',
            'email'     => 'required|unique:moderators',
            'contact'   => ['required','regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
            'address'   => 'required',
            'image'     => 'required|mimes:jpeg,jpg,png'
        ];
    }
    public function messages()
    {
        return [
            'cpassword.required' => 'Confirm Password Required',
            'cpassword.same' => 'Confirm Password Dose Not Match'
        ];
    }
}
