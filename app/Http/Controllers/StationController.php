<?php

namespace App\Http\Controllers;

use App\Services\StationService;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Http\Requests\Station\CreateStationRequest;

class StationController extends Controller
{
    protected $stationService;

    public function __construct(StationService $stationService)
    {
        $this->middleware('jwt.auth', ['except' => ['getAllSystemStations', 'getWeathers', 'getUserByStation']]);
        $this->stationService = $stationService;
    }

    public function getUserStations($id){
        return $this->stationService->getUserStations($id);
    }

    public function getStation($id)
    {
        return $this->stationService->getStation($id);
    }

    public function createStation(CreateStationRequest $request)
    {
        return $this->stationService->createStation($request);
    }

    public function updateStation(UpdateStationRequest $request)
    {
        return $this->stationService->updateStation($request);
    }

    public function deleteStation($id)
    {
        return $this->stationService->delete($id);
    }

    public function getWeathers($id, $count = null)
    {
        return $this->stationService->getStationWeathers($id, $count);
    }

    public function getAllSystemStations()
    {
        return $this->stationService->getAllSystemStations();
    }
}
