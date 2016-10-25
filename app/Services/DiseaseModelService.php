<?php

namespace App\Services;

use App\Models\DiseaseCondition;
use App\Models\DiseaseModel;

interface IDiseaseModelService
{
    function create($request);
    function update($model);
    function getAllModels();
    function getModelConditions($id);
    function getModelWithConditions($modelId);
    function checkDiseasesModels($stationId);
}

class DiseaseModelService implements IDiseaseModelService
{
    protected $diseaseModel;
    protected $diseaseCondition;
    protected $diseaseModelConditionService;
    protected $followDiseaseModelService;
    protected $stationService;
    protected $weatherService;

    public function __construct(
        DiseaseModel $diseaseModel,
        DiseaseCondition $diseaseCondition,
        DiseaseModelConditionService $diseaseModelConditionService,
        FollowDiseaseModelService $followDiseaseModelService,
        StationService $stationService,
        WeatherService $weatherService)
    {
        $this->diseaseModel = $diseaseModel;
        $this->diseaseCondition = $diseaseCondition;
        $this->diseaseModelConditionService = $diseaseModelConditionService;
        $this->followDiseaseModelService = $followDiseaseModelService;
        $this->stationService = $stationService;
        $this->weatherService = $weatherService;
    }

    public function create($data)
    {
        $diseaseModel = new DiseaseModel();
        $diseaseModel->name = $data->name;
        $diseaseModel->description = $data->description;
        $diseaseModel->user_id = $data->user_id;
        $diseaseModel->save();

        return $diseaseModel;
    }

    public function update($model)
    {
        $diseaseModel = $this->diseaseModel->find($model->id);
        $diseaseModel->name = $model->name;
        $diseaseModel->description = $model->description;
        $diseaseModel->user_id = $model->user_id;
        $this->diseaseModelConditionService->updateConditions($model->conditions);
        $diseaseModel->save();

        return getModelWithConditions($model->id, $model->user_id);
    }

    public function getAllModels()
    {
        return $this->diseaseModel->all();
    }

    public function getModelConditions($id)
    {
        $model = $this->diseaseModel->find($id);
        if($model != null)
            return $model->conditions;

    }

    public function getModelWithConditions($modelId)
    {
        $model = $this->diseaseModel->find($modelId);
        if($model != null) {
            $model->conditions = $model->conditions;
            return $model;
        }

        return null;
    }

    public function checkDiseasesModels($stationId)
    {
        $results = [];
        $stationModels = $this->followDiseaseModelService->getStationDiseaseModels($stationId);

        if (!$stationModels->isEmpty()){

            foreach($stationModels as $model)
            {
                $res = $this->weatherService->checkParameters($stationId, $this->getModelConditions($model->disease_model_id));
                array_push($results, $res);
            }
        }

        return $results;
    }
}