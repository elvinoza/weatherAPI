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
            'user_id' => 'required',
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
            'current_password.required' => 'Current password is required.',
            'current_password.min' => 'The password has to be more than 5 characters long.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'The new password has to be more than 5 characters long.',
            'new_password.confirmed' => 'The new password not confirmed.'
        );
    }
}