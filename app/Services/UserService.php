<?php

namespace App\Services;

use DB;
use App\Models\User;

interface IUserService
{
    function getUser($id);
    function update($user_id, $data);
    function getUserStations($id);
    function getUserStationsLastData($id);
}

class UserService implements IUserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser($id)
    {
        return $this->user->find($id);
    }

    public function update($user_id, $data)
    {
        $user = $this->user->find($user_id);
        $user->name = $data->name;
        $user->email = $data->email;
        $user->save();
        return $user;
    }

    public function getUserStations($id)
    {
        $user = $this->user->find($id);
        if ($user != null)
            return $user->stations;
        else return emptyArray();
    }

    public function getUserStationsLastData($id)
    {
        $user = $this->user->find($id);

        if($user != null){
            $data = DB::table('stations')
                ->join('weathers', function($join){
                    $join->on('weathers.station_id', '=', 'stations.id')
                        ->on('weathers.id', '=', DB::raw('(select id from weathers where station_id = stations.id order by created_at DESC LIMIT 1)'));
                })
                ->where('stations.user_id', '=', $user->id)
                ->get();
            return $data;
        }
        else return null;
    }
}