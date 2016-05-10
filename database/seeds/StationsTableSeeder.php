<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Station;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('stations')->delete();

        $stations = array(
            ['user_id' => 1, 'name' => 'station 1', 'location' => 'Kaunas', 'update_time' => 60, 'isValid' => true],
            ['user_id' => 1, 'name' => 'station 2', 'location' => 'Kaunas', 'update_time' => 60, 'isValid' => true],
            ['user_id' => 1, 'name' => 'station 3', 'location' => 'Kaunas', 'update_time' => 60, 'isValid' => true],
            ['user_id' => 2, 'name' => 'station 4', 'location' => 'Kaunas', 'update_time' => 60, 'isValid' => true]
        );

        foreach ($stations as $station)
        {
            Station::create($station);
        }

        Model::reguard();
    }
}
