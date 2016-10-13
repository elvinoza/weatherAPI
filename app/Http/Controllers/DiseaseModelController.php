<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiseaseModels\UpdateDiseaseModelWithConditionsRequest;
use App\Services\DiseaseModelConditionService;
use App\Services\DiseaseModelService;
use App\Http\Requests\DiseaseModels\CreateDiseaseModelRequest;
use App\Http\Requests\DiseaseModels\CreateDiseaseModelConditionRequest;

class DiseaseModelController extends Controller
{
    protected $diseaseModelService;
    protected $diseaseModelConditionService;

    public function __construct(
        DiseaseModelService $diseaseModelService,
        DiseaseModelConditionService $diseaseModelConditionService)
    {
        $this->middleware('jwt.auth', ['except' => ['change']]);
        $this->diseaseModelService = $diseaseModelService;
        $this->diseaseModelConditionService = $diseaseModelConditionService;
    }

    public function create(CreateDiseaseModelRequest $request)
    {
        return $this->diseaseModelService->create($request);
    }

    public function createConditions(CreateDiseaseModelConditionRequest $request)
    {
        return $this->diseaseModelConditionService->createConditions($request);
    }

    public function getAllModels()
    {
        return $this->diseaseModelService->getAllModels();
    }

    public function getModel($id)
    {
        $user = \JWTAuth::parseToken()->authenticate();

        return $this->diseaseModelService->getModelWithConditions($id, $user->id);
    }

    public function update(UpdateDiseaseModelWithConditionsRequest $request){
        $model = json_decode($request->getContent());

        return $this->diseaseModelService->update($model);
    }

    public function change()
    {
    }
}