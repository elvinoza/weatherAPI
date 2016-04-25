<?php

namespace App\Services;

use App\Repositories\IStationRepository;
use App\Repositories\StationRepository;

class StationService {
    /**
     * The StationRepository instance.
     *
     * @var App\Repositories\StationRepository
     */
    protected $stationRepository;

    private $asd;

    public function __constructor(StationRepository $stationRepository){
        $this->stationRepository = $stationRepository;
    }

    public function kuku()
    {
        return dump($this->stationRepository->index());
    }
}