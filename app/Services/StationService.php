<?php

namespace App\Services;

use App\Models\Station;

interface IStationInterface
{
    function getUserStations($id);
    function getStation($id);
}

class StationService implements IStationInterface{

    protected $station;

    public function __constructor(Station $station){
        $this->station = $station;
    }

    public function getUserStations($id)
    {
        return $this->station->where('user_id', $id);
    }

    public function getStation($id)
    {
        return $this->station->find($id);
    }
}