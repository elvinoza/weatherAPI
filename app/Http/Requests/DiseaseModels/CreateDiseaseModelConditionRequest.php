<?php

namespace App\Http\Requests\DiseaseModels;

use App\Http\Requests\Request;

class CreateDiseaseModelConditionRequest extends Request {

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

        foreach($content->conditions as $key => $val)
        {
            $rules['conditions.'.$key.'.id'] = 'required|integer';
            $rules['conditions.'.$key.'.disease_model_id'] = 'required|integer';
            $rules['conditions.'.$key.'.clsf_weather_parameter'] = 'required|integer';
            $rules['conditions.'.$key.'.date_range'] = 'required|boolean';

            if (isset($val->date_range))
                if ($val->date_range) {
                    $rules['conditions.'.$key.'.start_range'] = 'required|numeric';
                    $rules['conditions.'.$key.'.end_range'] = 'required|numeric';
                } else {
                    $rules['conditions.'.$key.'.constant'] = 'required|numeric';
                    $rules['conditions.'.$key.'.operator'] = 'required|boolean';
                }

            $rules['conditions.'.$key.'.time'] = 'required|integer';
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
            '*.disease_model_id.required' => 'Disease Model Id is required.',
            '*.disease_model_id.integer' => 'Disease Model Id must be integer.',
            '*.clsf_weather_parameter.required' => 'Weather parameter is required.',
            '*.clsf_weather_parameter.integer' => 'Weather parameter  must be integer.',
            '*.date_range.required' => 'Date range is required.',
            '*.date_range.boolean' => 'Date_range must be boolean.',
            '*.start_range.required' => 'From is required.',
            '*.start_range.numeric' => 'From must be numeric.',
            '*.end_range.required' => 'To is required.',
            '*.end_range.numeric' => 'To must be numeric.',
            '*.constant.required' => 'Constant is required.',
            '*.constant.numeric' => 'Constant must be numeric.',
            '*.operator.required' => 'Compare operator is required.',
            '*.operator.boolean' => 'Compare operator must be boolean.',
            '*.time.required' => 'Interval in days is required.',
            '*.time.integer' => 'Interval in days must be integer.'
        );
    }
}