<?php

use App\Models\FollowDiseaseModel;

class FollowDiseaseModelTest extends TestCase
{
    /**
     * Create Follow Disease Model Test.
     *
     * @return void
     */
    public function testCreateFollowDiseaseModel()
    {
        $followDiseaseModel = factory(FollowDiseaseModel::class)->create();

        $this->seeInDatabase('follow_disease_model', [
            'id' => $followDiseaseModel->id,
            'user_id' => $followDiseaseModel->user_id,
            'disease_model_id' => $followDiseaseModel->disease_model_id,
            'station_id' => $followDiseaseModel->station_id,
            'is_valid' => $followDiseaseModel->is_valid
        ]);

        $followDiseaseModel->delete();
    }

    /**
     * Delete Follow Disease Model Test.
     *
     * @return void
     */
    public function testDeleteFollowDiseaseModel()
    {
        $followDiseaseModel = factory(FollowDiseaseModel::class)->create();

        $this->seeInDatabase('follow_disease_model', [
            'id' => $followDiseaseModel->id,
            'user_id' => $followDiseaseModel->user_id,
            'disease_model_id' => $followDiseaseModel->disease_model_id,
            'station_id' => $followDiseaseModel->station_id,
            'is_valid' => $followDiseaseModel->is_valid
        ]);

        $followDiseaseModel->delete();

        $this->notSeeInDatabase('follow_disease_model', [
            'id' => $followDiseaseModel->id,
            'user_id' => $followDiseaseModel->user_id,
            'disease_model_id' => $followDiseaseModel->disease_model_id,
            'station_id' => $followDiseaseModel->station_id,
            'is_valid' => $followDiseaseModel->is_valid
        ]);
    }
}
