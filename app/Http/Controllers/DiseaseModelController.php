<?php

namespace App\Http\Controllers;

use App\Services\DiseaseModelService;
use App\Http\Requests\DiseaseModels\CreateDiseaseModelRequest;

class DiseaseModelController extends Controller
{
    protected $diseaseModelService;

    public function __construct(DiseaseModelService $diseaseModelService)
    {
        $this->middleware('jwt.auth', ['except' => ['change']]);
        $this->diseaseModelService = $diseaseModelService;
    }

    public function create(CreateDiseaseModelRequest $request)
    {
        return $this->diseaseModelService->create($request);
    }

    public function getAllModels()
    {
        return $this->diseaseModelService->getAllModels();
    }

    public function change()
    {
    }
}