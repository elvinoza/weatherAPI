<?php

namespace App\Services;

use App\Models\DiseaseModel;

interface IDiseaseModelService
{
    function create($request);
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
        $diseaseModel->location = $data->location;
        $diseaseModel->user_id = $data->user_id;
        $diseaseModel->save();
        return $diseaseModel;
    }
}