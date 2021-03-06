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
    function getStationWeathers($id, $count);
    function getStationUpdateTime($id);
    function getUserByStation($stationId);
    function getAllSystemStations();
    function getStationName($id);
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
        return $this->station->where('user_id', $id)->get();
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
        $station->lat = $data->lat;
        $station->lng = $data->lng;
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
        $station->lat = $data->lat;
        $station->lng = $data->lng;
        $station->app_key = $this->generateAppKey();
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

    public function getStationWeathers($id, $count)
    {
        $station = $this->station->find($id);
        if($count == null) {
            return $station->weathers()->orderBy('created_at', 'DESC')->get();
        } else {
            return $station->weathers()->orderBy('created_at', 'DESC')->take($count)->get();
        }
    }

    public function getStationUpdateTime($id)
    {
        $station = $this->station->find($id);
        return response(['time' => $station->update_time], 200);
    }

    public function getUserByStation($stationId)
    {
        return $this->station->find($stationId)->user;
    }

    public function getAllSystemStations()
    {
        return $this->station->where('isValid', 1)->get();
    }

    private function generateAppKey()
    {
        $app_key = "";
        $api_credentials = true;
        while ($api_credentials){
            $app_key = $this->generateRandomString(32);
            if(is_null($this->station->where('app_key', '=', $app_key))){
                $api_credentials = true;
            }
            else $api_credentials = false;
        }

        return $app_key;
    }

    public function getStationName($id)
    {
        return $this->station->find($id)->name;
    }

    private function generateRandomString($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}