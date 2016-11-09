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
            'conditions.*.id.required' => 'Id is required.',
            'conditions.*.id.integer' => 'Id must be integer.',
            'conditions.*.disease_model_id.required' => 'Disease Model Id is required.',
            'conditions.*.disease_model_id.integer' => 'Disease Model Id must be integer.',
            'conditions.*.clsf_weather_parameter.required' => 'clsf_weather_parameter is required.',
            'conditions.*.clsf_weather_parameter.integer' => 'clsf_weather_parameter must be integer.',
            'conditions.*.date_range.required' => 'date_range is required.',
            'conditions.*.date_range.boolean' => 'date_range must be boolean.',
            'conditions.*.start_range.required' => 'start_range is required.',
            'conditions.*.start_range.numeric' => 'date_range must be numeric.',
            'conditions.*.end_range.required' => 'end_range is required.',
            'conditions.*.end_range.numeric' => 'end_range must be numeric.',
            'conditions.*.constant.required' => 'constant is required.',
            'conditions.*.constant.numeric' => 'constant must be numeric.',
            'conditions.*.operator.required' => 'operator is required.',
            'conditions.*.operator.boolean' => 'operator must be boolean.',
            'conditions.*.time.required' => 'Time is required.',
            'conditions.*.time.integer' => 'Time must be integer.',
        );
    }
}