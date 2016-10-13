<?php

namespace App\Http\Requests\FollowModel;

use App\Http\Requests\Request;

class SetUserFollowModelRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'exists:users,id',
            'disease_model_id' => 'exists:disease_models,id'
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
            'user_id.exists' => 'User not exists in database.',
            'disease_model_id.exists' => 'Disease model not exists in database.'
        );
    }
}