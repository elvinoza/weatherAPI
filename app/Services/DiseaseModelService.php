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
    function getModelWithConditions($id);
}

class DiseaseModelService implements IDiseaseModelService
{
    protected $diseaseModel;
    protected $diseaseCondition;
    protected $diseaseModelConditionService;

    public function __construct(
        DiseaseModel $diseaseModel,
        DiseaseCondition $diseaseCondition,
        DiseaseModelConditionService $diseaseModelConditionService)
    {
        $this->diseaseModel = $diseaseModel;
        $this->diseaseCondition = $diseaseCondition;
        $this->diseaseModelConditionService = $diseaseModelConditionService;
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

        return getModelWithConditions($model->id);
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

    public function getModelWithConditions($id)
    {
        $model = $this->diseaseModel->find($id);
        if($model != null) {
            $model->conditions = $model->conditions;
            return $model;
        }

        return null;
    }
}