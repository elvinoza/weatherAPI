<?php namespace App\Http\Requests;

class UpdateStationRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:stations,name,' . $this->input('id'),
            'location' => 'max:255',
            'update_time' => 'required|integer'
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
            'location.max' => 'Per ilgas pavadinimas',
            'update_time.required' => 'Butinas atnaujinimo laikas',
            'update_time.integer' => 'Tik sveikas skaicius.'
        );
    }
}