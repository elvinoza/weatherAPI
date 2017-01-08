<?php

namespace App\Http\Requests\Forecast;

use App\Http\Requests\Request;

class FilterAllForecastRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'startDate' => 'required',
            'endDate' => 'required'
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
            'startDate.required' => 'Start date is required.',
            'endDate.required' => 'End date is required.'
        );
    }
}