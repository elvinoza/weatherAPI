<?php

namespace App\Services;

use DB;
use App\Models\FollowDiseaseModel;

interface IFollowDiseaseModel
{
    function setUserFollowModel($userId, $stationId, $modelId);
    function checkUserFollowModel($userId, $modelId);
    function changeStationFollowModelStatus($userId, $stationId, $modelId);
    function getAllUserFollowModels($userId);
    function getModelUserStations($userId, $modelId);
}

class FollowDiseaseModelService implements IFollowDiseaseModel
{
    protected $followDiseaseModel;
    protected $userStation;

    public function __construct(
        FollowDiseaseModel $followDiseaseModel,
        StationService $stationService)
    {
        $this->followDiseaseModel = $followDiseaseModel;
        $this->userStation = $stationService;
    }

    public function setUserFollowModel($userId, $stationId, $modelId)
    {
        $userFollowModel = new FollowDiseaseModel();
        $userFollowModel->user_id = $userId;
        $userFollowModel->station_id = $stationId;
        $userFollowModel->disease_model_id = $modelId;
        $userFollowModel->save();

        return $userFollowModel;
    }

    public function checkUserFollowModel($userId, $modelId)
    {
        $model = $this->followDiseaseModel->where('user_id', $userId)->where('disease_model_id', $modelId)->get()->first();

        if ($model == null){
            return false;
        } else {
            return (bool) $model->is_valid;
        }
    }

    public function checkStationFollowModel($stationId, $modelId)
    {
        $model = $this->followDiseaseModel->where('station_id', $stationId)->where('disease_model_id', $modelId)->get()->first();

        if ($model == null){
            return false;
        } else {
            return (bool) $model->is_valid;
        }
    }

    public function changeStationFollowModelStatus($userId, $stationId, $modelId)
    {
        $model = $this->followDiseaseModel->where('user_id', $userId)->where('station_id', $stationId)->where('disease_model_id', $modelId)->get()->first();

        if ($model == null){
            return $this->setUserFollowModel($userId, $stationId, $modelId);
        } else {
            if ($model->is_valid){
                $model->is_valid = false;
            } else {
                $model->is_valid = true;
            }
            $model->save();

            return $model;
        }
    }

    public function getAllUserFollowModels($userId)
    {
        return $this->followDiseaseModel->where('user_id', $userId)->get();
    }

    public function getModelUserStations($userId, $modelId)
    {
        $stations = DB::table('stations as station')
            ->select(DB::raw("station.*, CASE WHEN (SELECT fmd.is_valid FROM follow_disease_model fmd WHERE fmd.station_id = station.id AND fmd.user_id = station.user_id AND fmd.disease_model_id = ?) != FALSE THEN True ELSE False END as follow"))->setBindings([$modelId])
            ->where('station.user_id','=', $userId)

            ->get();

        return $stations;
    }
}