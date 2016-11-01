<?php

use App\Models\Station;
use App\Services\StationService;

class ApiStationControllerTest extends TestCase
{
    protected $station;
    protected $stationService;

    public function setUp()
    {
        parent::setUp();

        $this->station = factory(Station::class)->create();
        $this->stationService = new StationService(new Station());
    }

    /**
     * Get Station Update Time Test.
     *
     * @return void
     */
    public function testGetStationUpdateTime()
    {
        $response = $this->json('GET', '/stationAPI/station/updateTime/' . $this->station->id);

        $response->seeJson([
            'time' => $this->station->update_time
        ]);
    }

    /**
     * Insert Data From Station
     *
     * @return void
     */
    public function testInsertDataFromStation()
    {
        $station = $this->stationService->getStation(5);

        $data = [
            'station_id' => $station->id,
            'app_key' => $station->app_key,
            'temperature' => 1.3,
            'humidity' => 60.05,
            'pressure' => 2500,
            'soil_temperature' => 10.51,
            'soil_humidity' => 45.88,
            'wind_speed' => 121.85,
            'wind_direction' => 120,
            'rain' => 12.20
        ];

        $response = $this->json('POST', '/stationAPI/create', $data);

        $response->seeJson([
            'success' => true
        ]);
    }

    public function tearDown()
    {
        $this->station->delete();

        parent::tearDown();
    }
}
