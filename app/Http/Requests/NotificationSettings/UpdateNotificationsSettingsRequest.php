<?php

namespace App\Http\Requests\NotificationSettings;

use App\Http\Requests\Request;

class UpdateNotificationsSettingsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $this->request = json_decode($this->content);
        $content = $this->request;

        foreach($content as $key => $val)
        {
            $rules[$key.'.id'] = 'required|integer';
            $rules[$key.'.station_id'] = 'required|integer';
            $rules[$key.'.clsf_weather_parameter'] = 'required|integer';
            $rules[$key.'.compare_operator'] = 'required|integer';
            $rules[$key.'.value'] = 'required|numeric';
            $rules[$key.'.is_active'] = 'required|boolean';
            $rules[$key.'.is_valid'] = 'required|boolean';
        }

        return $rules;
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
            '*.id.required' => 'Id is required.',
            '*.id.integer' => 'Id must be integer.',
            '*.station_id.required' => 'station_id is required.',
            '*.station_id.integer' => 'station_id must be integer.',
            '*.clsf_weather_parameter.required' => 'clsf_weather_parameter is required.',
            '*.clsf_weather_parameter.integer' => 'clsf_weather_parameter must be integer.',
        );
    }
}