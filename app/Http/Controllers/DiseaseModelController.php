<?php

namespace App\Http\Controllers;

use App\Services\DiseaseModelService;

class DiseaseModelController extends Controller
{
    protected $diseaseModelService;

    public function __construct(DiseaseModelService $diseaseModelService)
    {
        $this->middleware('jwt.auth', ['except' => ['change']]);
        $this->diseaseModelService = $diseaseModelService;
    }

    public function change()
    {

    }
}