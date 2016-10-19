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

    public function changeUserFollowModelStatus(SetUserFollowModelRequest $request)
    {
        return $this->followDiseaseModelService->changeStationFollowModelStatus($request->user_id, $request->station_id, $request->disease_model_id);
    }

    public function checkUserFollowModel(SetUserFollowModelRequest $req)
    {
        return response()->json($this->followDiseaseModelService->checkUserFollowModel($req->user_id, $req->disease_model_id));
    }

    public function getUserModelFollows($userId, $modelId)
    {
        return $this->followDiseaseModelService->getModelUserStations($userId, $modelId);
    }
}
