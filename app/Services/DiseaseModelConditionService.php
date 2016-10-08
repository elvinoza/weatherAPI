<?php

namespace App\Services;

use App\Models\DiseaseCondition;

interface IDiseaseModelConditionService
{
    function createConditions($data);
    function updateConditions($conditions);
}

class DiseaseModelConditionService implements IDiseaseModelConditionService
{
    protected $diseaseCondition;

    public function __construct(DiseaseCondition $diseaseCondition)
    {
        $this->diseaseCondition = $diseaseCondition;
    }

    public function createConditions($data)
    {
        $conditions = json_decode($data->getContent())->conditions;

        foreach ($conditions as $condition) {
            $diseaseCondition = new DiseaseCondition();
            $diseaseCondition->disease_model_id = $condition->disease_model_id;
            $diseaseCondition->clsf_weather_parameter = $condition->clsf_weather_parameter;

            if($condition->date_range){
                $diseaseCondition->start_range = $condition->start_range;
                $diseaseCondition->end_range = $condition->end_range;
            } else {
                $diseaseCondition->constant = $condition->constant;
                $diseaseCondition->operator = $condition->operator;
            }

            $diseaseCondition->time = $condition->time;
            $diseaseCondition->save();
        }

        return response(['success' => true], 200);
    }

    public function updateConditions($conditions)
    {
        foreach($conditions as $condition)
        {
            $diseaseCondition = $this->diseaseCondition->find($condition->id);

            $diseaseCondition->clsf_weather_parameter = $condition->clsf_weather_parameter;

            if($condition->date_range){
                $diseaseCondition->start_range = $condition->start_range;
                $diseaseCondition->end_range = $condition->end_range;
            } else {
                $diseaseCondition->constant = $condition->constant;
                $diseaseCondition->operator = $condition->operator;
            }

            $diseaseCondition->time = $condition->time;
            $diseaseCondition->save();
        }
    }
}