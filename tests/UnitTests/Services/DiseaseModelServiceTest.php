<?php

use App\Services\DiseaseModelService;
use App\Services\DiseaseModelConditionService;
use App\Models\DiseaseModel;
use App\Models\DiseaseCondition;

class DiseaseModelServiceTest extends TestCase
{
    protected $createdDiseaseModelList;
    protected $diseaseModelService;
    protected $diseaseModel;

    public function setUp()
    {
        parent::setUp();

        $this->diseaseModel = factory(DiseaseModel::class)->create();
        $this->createdDiseaseModelList = [];
    }


    public function tearDown()
    {
        foreach ($this->createdUserList as $user) {
            User::find($user)->delete();
        }

        $this->user->delete();

        parent::tearDown();
    }
}
