<?php

use App\Models\Station;
use App\Services\StationService;
use App\Models\Notification;

class ApiStationControllerTest extends TestCase
{
    protected $station;
    protected $stationService;
    protected $notificationId;

    public function setUp()
    {
        parent::setUp();

        $this->station = factory(Station::class)->create();
        $this->stationService = new StationService(new Station());
        $this->notificationId = null;
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
     * Insert Data From Station (Success test)
     *
     * @return void
     */
    public function testInsertDataFromStation()
    {
        $station = $this->stationService->getStation(5);

        $data = [
            'station_id' => $station->id,
            'app_key' => $station->app_key,
            'temperature' => 14,
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

        //check for notification
        $notification = Notification::where('user_id', $station->user_id)->where('disease_model_id', 54)->get()->first();
        $this->assertNotNull($notification);

        $this->notificationId = $notification->id;

        $this->assertEquals("In the station sadsa detected model (AAAAA) conditions. Please investigate it!", $notification->full_message);
    }

    public function tearDown()
    {
        $this->station->delete();
        if ($this->notificationId != null)
            Notification::find($this->notificationId)->delete();

        parent::tearDown();
    }
}
