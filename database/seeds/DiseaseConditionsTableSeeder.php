<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiseaseCondition;
use App\Enums\ClsfWeatherParameters;

class DiseaseConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('disease_conditions')->delete();

        $diseaseConditions = array(
            ['disease_model_id' => 1, 'clsf_weather_parameter' => ClsfWeatherParameters::Temperature, 'start_range' => 12.3,
                'end_range' => 18.7, 'constant' => null, 'operator' => false, 'time' => 10],
            ['disease_model_id' => 1, 'clsf_weather_parameter' => ClsfWeatherParameters::Humidity, 'start_range' => 50,
                'end_range' => 68, 'constant' => null, 'operator' => false, 'time' => 1]
        );

        foreach ($diseaseConditions as $diseaseCondition)
        {
            DiseaseCondition::create($diseaseCondition);
        }

        Model::reguard();
    }
}
