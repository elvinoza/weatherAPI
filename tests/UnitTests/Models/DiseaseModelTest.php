<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\DiseaseModel;

class DiseaseModelTest extends TestCase
{
    /**
     * Create Station Test.
     *
     * @return void
     */
    public function testCreateDiseaseModel()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();

        $this->seeInDatabase('disease_models', [
            'id' => $diseaseModel->id,
            'name' => $diseaseModel->name,
            'description' => $diseaseModel->description,
            'user_id' => $diseaseModel->user_id
        ]);

        $diseaseModel->delete();
    }

    /**
     * Delete Station Test.
     *
     * @return void
     */
    public function testDeleteDiseaseModelCondition()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();

        $this->seeInDatabase('disease_models', [
            'id' => $diseaseModel->id,
            'name' => $diseaseModel->name,
            'description' => $diseaseModel->description,
            'user_id' => $diseaseModel->user_id
        ]);

        $diseaseModel->delete();

        $this->notSeeInDatabase('disease_models', [
            'id' => $diseaseModel->id,
            'name' => $diseaseModel->name,
            'description' => $diseaseModel->description,
            'user_id' => $diseaseModel->user_id
        ]);
    }
}
