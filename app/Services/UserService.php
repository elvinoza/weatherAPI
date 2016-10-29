<?php

namespace App\Services;

use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

interface IUserService
{
    function createUser($data);
    function getUser($id);
    function update($user_id, $data);
    function changeUserPassword($data);
    function getUserStations($id);
    function getUserStationsLastData($id);
    function getUserDiseaseModels($id);
    function getUserNotifications($id);
    function delete($id);
}

class UserService implements IUserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser($data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->save();

        return $user;
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

    public function changeUserPassword($data)
    {
        $user = $this->user->find($data->user_id);
        if($user != null){
            if(Hash::check($data->current_password, $user->password))
            {
                $user->password = bcrypt($data->new_password);
                $user->save();
            }
            else {
                return response(['current_password' => 'Blogai nurodytas dabartinis slaptažodis.'], 422);
            }
        }

        return null;
    }

    public function getUserStations($id)
    {
        $user = $this->user->find($id);
        if ($user != null)
            return $user->stations->where('isValid', 1);
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

        return null;
    }

    public function getUserDiseaseModels($id)
    {
        $user = $this->user->find($id);
        if ($user != null)
            return $user->diseaseModels;
        else return emptyArray();
    }

    public function getUserNotifications($id, $count = null)
    {
        $user = $this->user->find($id);
        if ($user != null) {
            if ($count != null)
                return $user->notifications()->orderBy('created_at', 'DESC')->take($count)->get();

            return $user->notifications()->orderBy('created_at', 'DESC')->get();
        }
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        $user->delete();
    }
}