<?php

namespace App\Services;

use App\Models\FollowDiseaseModel;

interface IFollowDiseaseModel
{
    function setUserFollowModel($userId, $modelId);
    function checkUserFollowModel($userId, $modelId);
    function changeUserFollowModelStatus($userId, $modelId);
}

class FollowDiseaseModelService implements IFollowDiseaseModel
{
    protected $followDiseaseModel;

    public function __construct(FollowDiseaseModel $followDiseaseModel)
    {
        $this->followDiseaseModel = $followDiseaseModel;
    }

    public function setUserFollowModel($userId, $modelId)
    {
        $userFollowModel = new FollowDiseaseModel();
        $userFollowModel->user_id = $userId;
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

    public function changeUserFollowModelStatus($userId, $modelId)
    {
        $model = $this->followDiseaseModel->where('user_id', $userId)->where('disease_model_id', $modelId)->get()->first();

        if ($model == null){
            return $this->setUserFollowModel($userId, $modelId);
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
}