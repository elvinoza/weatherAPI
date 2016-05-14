<?php

namespace App\Http\Requests\ApiStation;

use App\Http\Requests\Request;
use App\Models\Station;

class CreateWeatherRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'station_id' => 'required|integer',
            'app_key' => 'required',
            'temperature' => 'required',
            'humidity' => 'required',
            'pressure' => 'required',
            'soil_temperature' => 'required',
            'soil_humidity' => 'required',
            'wind_speed' => 'required',
            'wind_direction' => 'required|integer',
            'rain' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $stationId = $this->input('station_id');

        return Station::where('id', '=', $stationId)
            ->where('app_key', '=', $this->input('app_key'))
            ->exists();
    }

    public function wantsJson()
    {
        return true;
    }
}