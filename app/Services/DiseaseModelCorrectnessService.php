<?php

namespace App\Services;

use App\Enums\CompareOperators;
use App\Helpers\Helper;
use App\Models\Weather;

interface IDiseaseModelCorrectnessService
{
    function checkDiseasesModels($stationId);
}

class DiseaseModelCorrectnessService implements IDiseaseModelCorrectnessService
{
    protected $weather;
    protected $notifyService;
    protected $stationService;
    protected $diseaseModelService;
    protected $followDiseaseModelService;

    public function __construct(
        Weather $weather,
        NotifyService $notifyService,
        StationService $stationService,
        DiseaseModelService $diseaseModelService,
        FollowDiseaseModelService $followDiseaseModelService)
    {
        $this->weather = $weather;
        $this->notifyService = $notifyService;
        $this->stationService = $stationService;
        $this->diseaseModelService = $diseaseModelService;
        $this->followDiseaseModelService = $followDiseaseModelService;
    }

    public function checkDiseasesModels($stationId)
    {
        $user = $this->stationService->getUserByStation($stationId);
        $stationModels = $this->followDiseaseModelService->getStationDiseaseModels($stationId);

        if (!$stationModels->isEmpty()){
            foreach($stationModels as $model)
            {
                $res = $this->checkParameters($stationId, $this->diseaseModelService->getModelConditions($model->disease_model_id));
                if ($res) {
                    $this->notifyService->crateNotification($user->id, $model->disease_model_id, $model->model->name . " observed in station - " . $model->station->name,
                        $this->createNotificationMessage($model));
                }
            }
        }
    }

    private function createNotificationMessage($model)
    {
        if ($model->model->solution != null) {
            $message = "In the station " . $model->station->name . " detected model (" . $model->model->name . ") conditions. Please investigate it! Solution: " .
                $model->model->solution;
        }
        else
        {
            $message = "In the station " . $model->station->name . " detected model (" . $model->model->name . ") conditions. Please investigate it!";
        }

        return $message;
    }

    private function checkParameters($stationId, $conditions){

        foreach ($conditions as $condition)
        {
            $date = date("Y-m-d", strtotime(sprintf("-%d days", $condition->time)));

            $query = $this->weather
                ->where('station_id','=', $stationId)
                ->where('created_at', '>', $date);

            $query = $this->getByParameter($condition, $query);

            if ($query->get()->count()) {
                return false;
            }
        }

        return true;
    }

    private function getByParameter($condition, $query)
    {
        $parameter = Helper::ResolveWeatherParameter($condition->clsf_weather_parameter);

        if ($condition->start_range != null) {
            $query = $query->whereNotBetween($parameter, [$condition->start_range, $condition->end_range]);
        } else {
            $query = $query->where($parameter, $condition->operator == CompareOperators::LessThan ? '>' : '<', $condition->constant);
        }

        return $query;
    }
}