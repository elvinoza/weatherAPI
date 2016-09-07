<?php

namespace App\Http\Requests\DiseaseModels;

use App\Http\Requests\Request;

class CreateDiseaseModelRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:disease_models,name',
            'description' => 'required|max:255',
            'user_id' => 'required|integer'
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
            'description.required' => 'Description is required.',
            'description.max' => 'Description is too long.',
            'user_id.required' => 'User id is required.',
            'user_id.integer' => 'User id must be integer.'
        );
    }
}