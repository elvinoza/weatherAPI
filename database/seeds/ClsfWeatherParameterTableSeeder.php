<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClsfWeatherParameter;

class ClsfWeatherParameterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('clsf_weather_parameter')->delete();

        $parameters = array(
            ['name' => 'temperature'],
            ['name' => 'humidity'],
            ['name' => 'pressure'],
            ['name' => 'soil_temperature'],
            ['name' => 'soil_humidity'],
            ['name' => 'wind_speed'],
            ['name' => 'wind_direction'],
            ['name' => 'rain']
        );

        foreach ($parameters as $parameter)
        {
            ClsfWeatherParameter::create($parameter);
        }

        Model::reguard();
    }
}
