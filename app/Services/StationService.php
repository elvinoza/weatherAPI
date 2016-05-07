<?php

namespace App\Services;

use App\Models\Station;

interface IStationInterface
{
    function getUserStations($id);
    function getStation($id);
    function updateStation($station);
    function createStation($station);
    function delete($id);
    function getStationWeathers($id);
}

class StationService implements IStationInterface
{
    protected $station;

    public function __construct(Station $station)
    {
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

    public function updateStation($data)
    {
        $station = $this->station->find($data->id);
        $station->name = $data->name;
        $station->location = $data->location;
        $station->update_time = $data->update_time;
        $station->save();
        return $station;
    }

    public function createStation($data)
    {
        $station = new Station();
        $station->user_id = $data->user_id;
        $station->name = $data->name;
        $station->location = $data->location;
        $station->update_time = $data->update_time;
        $station->save();
        return $station;
    }

    public function delete($id)
    {
        $station = $this->station->find($id);
        $station->isValid = false;
        $station->save();
        return $station;
    }

    public function getStationWeathers($id)
    {
        $station = $this->station->find($id);
        return $station->weathers;
    }
}