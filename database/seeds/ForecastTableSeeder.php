<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Forecast;

class ForecastTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('forecast')->delete();

        $forecasts = array(
            ['station_id' => 2, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2, 'forecast_date' => Carbon::now()->toDateString(),],
            ['station_id' => 2, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2, 'forecast_date' => Carbon::now()->toDateString(),],
            ['station_id' => 3, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2, 'forecast_date' => Carbon::now()->toDateString(),],
            ['station_id' => 3, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2, 'forecast_date' => Carbon::now()->toDateString(),],
        );

        foreach ($forecasts as $forecast)
        {
            Forecast::create($forecast);
        }

        Model::reguard();
    }
}
