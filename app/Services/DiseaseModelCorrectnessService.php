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
    protected $diseaseModelService;
    protected $followDiseaseModelService;

    public function __construct(
        Weather $weather,
        DiseaseModelService $diseaseModelService,
        FollowDiseaseModelService $followDiseaseModelService)
    {
        $this->weather = $weather;
        $this->diseaseModelService = $diseaseModelService;
        $this->followDiseaseModelService = $followDiseaseModelService;
    }

    public function checkDiseasesModels($stationId)
    {
        $results = [];
        $stationModels = $this->followDiseaseModelService->getStationDiseaseModels($stationId);

        if (!$stationModels->isEmpty()){

            foreach($stationModels as $model)
            {
                $res = $this->checkParameters($stationId, $this->diseaseModelService->getModelConditions($model->disease_model_id));
                array_push($results, $res);
            }
        }

        return $results;
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