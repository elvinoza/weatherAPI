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
            'name.unique' => 'Toks stotelės varadas jau egzistuoja. Pabandykite kita!',
            'name.required' => 'butina ivesti varda',
            'name.min' => 'vardas ne trupmesnis nei 3 simb',
            'email.required' => 'Butina ivesti elektornini pastą.',
            'email.email' => 'Neteisingas elektroninis paštas. Turi būti example@pvz.lt',
            'email.unique' => 'Tokiu elektroniniu parstu jau yra uzregistruota stotele.'
        );
    }
}