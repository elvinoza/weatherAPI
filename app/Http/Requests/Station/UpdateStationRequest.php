<?php

namespace App\Http\Requests\Station;

use App\Http\Requests\Request;

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
            'location' => 'required|max:255',
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
            'name.unique' => 'Station name must be unique.',
            'name.required' => 'Station name is required.',
            'name.min' => 'Station name must be more than 3 char.',
            'location.required' => 'Station location is required.',
            'location.max' => 'Station location is too long.',
            'update_time.required' => 'Update time is required.',
            'update_time.integer' => 'Update time must be integer.'
        );
    }
}