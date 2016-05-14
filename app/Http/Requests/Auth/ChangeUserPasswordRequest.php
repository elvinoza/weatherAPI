<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class ChangeUserPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required|min:5',
            'new_password' => 'required|confirmed|min:5'
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
            'current_password.required' => 'Būtina įvesti seną slaptažodį norint jį pakeisti.',
            'current_password.min' => 'Slaptažodis turi būti ilgesnis nei 5 simboliai.',
            'new_password.required' => 'Būtina įvesti naują slaptažodį norint pakeisti senajį.',
            'new_password.min' => 'Naujas slaptažodis turi būti ilgesnis nei 5 simboliai.',
            'new_password.confirmed' => 'Naujas slaptažodis pakartotas neteisingai.'
        );
    }
}