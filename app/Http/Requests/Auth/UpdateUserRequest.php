<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if(Auth::user()->station_name == $this->input('station_name'))
            $name_id = Auth::user()->id;
        else $name_id = null;

        if(Auth::user()->email == $this->input('email'))
            $email_id = Auth::user()->id;
        else $email_id = null;

        return [
            'name' => 'required|min:3|unique:users,name,' . $name_id,
            'email' => 'required|email|unique:users,email,' . $email_id
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

    public function wantsJson()
    {
        return true;
    }

    /**
     * Error messages
     * @return array
     */
    public function messages(){
        return array(
            'name.unique' => 'The name must be unique.',
            'name.required' => 'The name is required.',
            'name.min' => 'The name has to be more than 3 characters long.',
            'email.required' => 'The email is required.',
            'email.email' => 'Your email must look like an e-mail address.',
            'email.unique' => 'Your email must be unique. Try another.'
        );
    }
}