<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Station;

class StationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Create Station Test.
     *
     * @return void
     */
    public function testCreateStation()
    {
        $user = factory(User::class)->create();

        $station = $user->stations()->create([
            'name' => 'NewStation',
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS03'
        ]);

        $found_station = Station::find($station->id);

        $this->assertEquals('NewStation', $found_station->name);
        $this->assertEquals('Kaunas', $found_station->location);
        $this->assertEquals(60, $found_station->update_time);
        $this->isTrue($found_station->isValid);
        $this->assertEquals('cFUmzZlWtsxaeupyboFNIzsR7Ow4PS03', $found_station->app_key);

        $this->seeInDatabase('stations', [
            'id' => $station->id,
            'name' => $station->name,
            'location' => $station->location,
            'app_key' => $station->app_key
        ]);

        $user->delete();
        $found_station->delete();
    }

    /**
     * Delete Station Test.
     *
     * @return void
     */
    public function testDeleteStation()
    {
        $user = factory(User::class)->create();

        $station = $user->stations()->create([
            'name' => 'NewStation',
            'location' => 'Kaunas',
            'update_time' => 60,
            'isValid' => true,
            'app_key' => 'cFUmzZlWtsxaeupyboFNIzsR7Ow4PS03'
        ]);

        $this->seeInDatabase('stations', [
            'id' => $station->id,
            'name' => $station->name,
            'location' => $station->location,
            'app_key' => $station->app_key
        ]);

        Station::find($station->id)->delete();

        $this->notSeeInDatabase('stations', [
            'id' => $station->id,
            'name' => $station->name,
            'location' => $station->location,
            'app_key' => $station->app_key
        ]);
    }
}
