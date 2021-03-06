<?php

namespace App\Http\Requests\DiseaseModels;

use App\Http\Requests\Request;

class UpdateDiseaseModelWithConditionsRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->request = json_decode($this->content);
        $content = $this->request;

        $rules['name'] = 'required|min:3|unique:disease_models,name,' . $content->id;
        $rules['description'] = 'required|max:255';
        $rules['solution'] = 'required|max:255';
        $rules['user_id'] = 'required|integer';

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
            'conditions.*.clsf_weather_parameter.required' => 'Weather parameter is required.',
            'conditions.*.clsf_weather_parameter.integer' => 'Weather parameter must be integer.',
            'conditions.*.date_range.required' => 'date_range is required.',
            'conditions.*.date_range.boolean' => 'date_range must be boolean.',
            'conditions.*.start_range.required' => 'From is required.',
            'conditions.*.start_range.numeric' => 'From must be numeric.',
            'conditions.*.end_range.required' => 'To is required.',
            'conditions.*.end_range.numeric' => 'To must be numeric.',
            'conditions.*.constant.required' => 'Constant is required.',
            'conditions.*.constant.numeric' => 'Constant must be numeric.',
            'conditions.*.operator.required' => 'Compare operator is required.',
            'conditions.*.operator.boolean' => 'Compare operator must be boolean.',
            'conditions.*.time.required' => 'Interval in days is required.',
            'conditions.*.time.integer' => 'Interval in days must be integer.',
            'name.unique' => 'Disease model name must be unique.',
            'name.required' => 'Disease model name is required.',
            'name.min' => 'Disease model name must be more than 3 char.',
            'description.required' => 'Description is required.',
            'description.max' => 'Description is too long.',
            'solution.required' => 'Solution is required.',
            'solution.max' => 'Solution is too long.',
            'user_id.required' => 'User id is required.',
            'user_id.integer' => 'User id must be integer.'
        );
    }
}