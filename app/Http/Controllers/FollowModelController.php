<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowModel\SetUserFollowModelRequest;
use App\Services\FollowDiseaseModelService;

class FollowModelController extends Controller
{
    protected $followDiseaseModelService;

    public function __construct(FollowDiseaseModelService $followDiseaseModelService)
    {
        $this->middleware('jwt.auth');
        $this->followDiseaseModelService = $followDiseaseModelService;
    }

    public function setUserFollowModel(SetUserFollowModelRequest $request)
    {
        return $this->followDiseaseModelService->setUserFollowModel($request->user_id, $request->disease_model_id);
    }

    public function check($userId, $modelId)
    {
        return $this->followDiseaseModelService->checkUserFollowModel($userId, $modelId);
    }
}
