<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\StationService;
use App\Models\User;
use App\Models\Station;

class StationServiceTest extends TestCase
{
    protected $user;
    protected $userMock;
    protected $stationService;
    protected $createdStationList;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->userMock = Mockery::mock('app\Models\User');
        $this->stationService = new StationService(new Station());
        $this->createdStationList = [];
    }

    /**
     * Create Station Test.
     *
     * @return void
     */
    public function testCreateStation()
    {
        $station = (object) array(
            'user_id' => $this->user->id,
            'name' => 'name',
            'location' => 'location',
            'isValid' => true,
            'update_time' => 20,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS04'
        );

        $station = $this->stationService->createStation($station);

        array_push($this->createdStationList, $station->id);

        $this->seeInDatabase('stations', ['id' => $station->id, 'name' => $station->name, 'location' => $station->location]);
    }

    /**
     * Get Station Test.
     *
     * @return void
     */
    public function testGetStation()
    {
        $station = $this->user->stations()->create([
            'name' => 'NewStation1',
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS05'
        ]);
        array_push($this->createdStationList, $station->id);

        $stationFromMethod = $this->stationService->getStation($station->id);

        $this->assertEquals($stationFromMethod->id, $station->id);
        $this->assertEquals($stationFromMethod->name, $station->name);
        $this->assertEquals($stationFromMethod->location, $station->location);
        $this->assertEquals(1, $stationFromMethod->isValid);
        $this->assertEquals($stationFromMethod->app_key, $station->app_key);
    }

    /**
     * Update Station Data Test.
     *
     * @return void
     */
    public function testUpdateStation()
    {
        $station = $this->user->stations()->create([
            'name' => 'NewStation',
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS06'
        ]);
        array_push($this->createdStationList, $station->id);

        $station->name = "changed";
        $station->update_time = 10;

        $stationFromMethod = $this->stationService->updateStation($station);

        $this->assertEquals($stationFromMethod->id, $station->id);
        $this->assertEquals($stationFromMethod->name, "changed");
        $this->assertEquals($stationFromMethod->update_time, 10);
    }

    /**
     * Soft Delete Station Data Test.
     *
     * @return void
     */
    public function testSoftDeleteStation()
    {
        $station = $this->user->stations()->create([
            'name' => 'NewStation',
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS06'
        ]);

        array_push($this->createdStationList, $station->id);

        $stationFromMethod = $this->stationService->delete($station->id);

        $this->assertEquals($stationFromMethod->id, $station->id);
        $this->assertEquals($stationFromMethod->isValid, 0);
    }

    public function tearDown()
    {
        foreach ($this->createdStationList as $station) {
            Station::find($station)->delete();
        }

        $this->user->delete();

        parent::tearDown();
    }
}
