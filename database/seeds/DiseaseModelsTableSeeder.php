<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiseaseModel;

class DiseaseModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('disease_models')->delete();

        $diseaseModels = array(
            ['name' => 'Apple', 'description' => 'Apple disease', 'user_id' => 1],
            ['name' => 'Banana', 'description' => 'Banana disease', 'user_id' => 1],
            ['name' => 'Cucumber', 'description' => 'Cucumber disease', 'user_id' => 1]
        );

        foreach ($diseaseModels as $disease)
        {
            DiseaseModel::create($disease);
        }

        Model::reguard();
    }
}
