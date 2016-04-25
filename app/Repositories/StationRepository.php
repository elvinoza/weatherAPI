<?php

namespace App\Repositories;

use App\Models\Station;

class StationRepository implements IStationRepository
{


    /**
     * Create a new StationRepository instance.
     *
     * @param  App\Models\Station $station
     * @return void
     */

    protected $model;

    public function __construct(Station $station)
    {
        $this->model = $station;
    }

    /**
     * Get stations collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function index()
    {
        echo "asd";
//        return $this->model
//            ->all();
    }

    /**
     * Save station
     *
     * @param  array $inputs
     * @param  int   $user_id
     * @return void
     */
    public function save($inputs, $user_id)
    {
        $station = new $this->model;
        $station->user_id = $user_id;
        $station->name = $inputs['name'];
        $station->location = $inputs['location'];
        $station->update_time = $inputs['update_time'];
        $station->save();
    }
}