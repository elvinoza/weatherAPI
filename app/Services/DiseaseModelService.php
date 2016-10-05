<?php

namespace App\Services;

use App\Models\DiseaseModel;

interface IDiseaseModelService
{
    function create($request);
    function getAllModels();
    function getModelConditions($id);
}

class DiseaseModelService implements IDiseaseModelService
{
    protected $diseaseModel;

    public function __construct(DiseaseModel $diseaseModel)
    {
        $this->diseaseModel = $diseaseModel;
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

    public function getAllModels()
    {
        return $this->diseaseModel->all();
    }

    public function getModelConditions($id)
    {
        $model = $this->diseaseModel->find($id);
        if($model != null)
            return $model->conditions();

    }
}