<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weather;

class WeathersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('weathers')->delete();

        $weathers = array(
            ['station_id' => 1, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2],
            ['station_id' => 1, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2],
            ['station_id' => 1, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2],
            ['station_id' => 2, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2],
            ['station_id' => 2, 'temperature' => 12.85, 'humidity' => 60.05, 'pressure' => 121010,
                'soil_temperature' => 10.52, 'soil_humidity' => 53.85, 'wind_speed' => 121.85, 'wind_direction' => 120,
                'rain' => 12.2],
        );

        foreach ($weathers as $weather)
        {
            Weather::create($weather);
        }

        Model::reguard();
    }
}
