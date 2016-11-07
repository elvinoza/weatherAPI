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
            ['name' => 'Temperature'],
            ['name' => 'Humidity'],
            ['name' => 'Pressure'],
            ['name' => 'Soil Temperature'],
            ['name' => 'Soil Humidity'],
            ['name' => 'Wind Speed'],
            ['name' => 'Wind Direction'],
            ['name' => 'Rain']
        );

        foreach ($parameters as $parameter)
        {
            ClsfWeatherParameter::create($parameter);
        }

        Model::reguard();
    }
}
