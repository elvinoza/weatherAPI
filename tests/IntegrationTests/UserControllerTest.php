<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use App\Models\Station;
use App\Models\Weather;

class UserCTest extends TestCase
{
    use WithoutMiddleware;

    protected $user;
    protected $stationId;
    protected $weatherId;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->stationId = null;
        $this->weatherId = null;
    }

    /**
     * Get Exists User Stations Test.
     *
     * @return void
     */
    public function testGetExistsUserStations()
    {
        $this->json('GET', '/api/user/stations/' . $this->user->id)->seeJson([]);
    }

    /**
     * Get Not Exists User Stations Test.
     *
     * @return void
     */
    public function testGetNotExistsUserStations()
    {
        $this->json('GET', '/api/user/stations/'. 9999)->seeJson([]);
    }

    /**
     * Get Exists User Notifications Test.
     *
     * @return void
     */
    public function testGetExistsUserNotifications()
    {
        $this->json('GET', '/api/user/allUserNotifications/' . $this->user->id)->seeJson([]);
    }

    /**
     * Get Not Exists User Notifications Test.
     *
     * @return void
     */
    public function testGetNotExistsUserNotifications()
    {
        $this->json('GET', '/api/user/allUserNotifications/'. 9999)->seeJson([]);
    }

    /**
     * Get Exists User Disease Models Test.
     *
     * @return void
     */
    public function testGetExistsUserDiseaseModels()
    {
        $this->json('GET', '/api/user/models/' . $this->user->id)->seeJson([]);
    }

    /**
     * Get Not Exists User Disease Models Test.
     *
     * @return void
     */
    public function testGetNotExistsUserDiseaseModels()
    {
        $this->json('GET', '/api/user/models/'. 9999)->seeJson([]);
    }

    /**
     * Get Latest User Stations Data Test.
     *
     * @return void
     */
    public function testGetExistingStationsLatestData()
    {
        $this->createUserStationData();
        $this->json('GET', '/api/user/StationsLastData/'. $this->user->id)->seeJson(['station_id' => $this->stationId, 'id' => $this->weatherId]);
    }

    private function createUserStationData()
    {
        $station = $this->user->stations()->create([
            'name' => 'NewStation1',
            'user_id' => $this->user->id,
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS05'
        ]);
        $this->stationId = $station->id;

        $weather = $station->weathers()->create([
                'station_id' => $station->id,
                'temperature' => 12.85,
                'humidity' => 60.05,
                'pressure' => 121010,
                'soil_temperature' => 10.52,
                'soil_humidity' => 53.85,
                'wind_speed' => 121.85,
                'wind_direction' => 120,
                'rain' => 12.2]
        );
        $this->weatherId = $weather->id;
    }

    public function tearDown()
    {
        if ($this->stationId != null) {
            Station::find($this->stationId)->delete();
            Weather::find($this->weatherId)->delete();
        }

        $this->user->delete();

        parent::tearDown();
    }
}
