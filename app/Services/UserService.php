<?php

namespace App\Services;

use App\Models\User;

interface IUserService
{
    function getUser($id);
    function update($user_id, $data);
    function getUserStations($id);
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
}