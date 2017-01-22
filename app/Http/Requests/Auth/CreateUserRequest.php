<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
        ];
    }

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
     * Error messages
     * @return array
     */
    public function messages(){
        return array(
            'name.required' => 'The name is required.',
            'name.min' => 'The name has to be more than 3 characters long.',
            'email.required' => 'The email is required.',
            'email.email' => 'Your email must look like an e-mail address.',
            'email.unique' => 'Your email must be unique. Try another.',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password must be confirmed.',
            'password.min' => 'The password has to be more than 3 characters long.',
        );
    }
}