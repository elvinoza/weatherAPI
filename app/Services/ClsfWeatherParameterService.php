<?php

namespace App\Services;

use App\Models\ClsfWeatherParameter;

interface IClsfWeatherParameterService
{
    function getAll();
    function getById($id);
}

class ClsfWeatherParameterService implements IClsfWeatherParameterService
{
    protected $weatherParam;

    public function __construct(ClsfWeatherParameter $weatherParameter)
    {
        $this->weatherParam = $weatherParameter;
    }

    public function getAll()
    {
        return $this->weatherParam->all();
    }

    public function getById($id)
    {
        return $this->weatherParam->where('id', $id)->get();
    }
}