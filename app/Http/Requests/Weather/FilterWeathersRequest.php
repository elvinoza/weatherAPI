<?php namespace App\Http\Requests\Weather;

use App\Http\Requests\Request;

class FilterWeathersRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'station_id' => 'required',
            'date' => 'required',
            'interval' => 'integer'
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
            'station_id.required' => 'Station id is required.',
            'date.required' => 'Date is required.',
            'interval.integer' => 'Interval must be integer.'
        );
    }
}