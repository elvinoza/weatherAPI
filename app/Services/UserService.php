<?php

namespace App\Services;

use App\Models\User;

interface IUserService
{
    function getUser($id);
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
        $user->update_time_min = $data->update_time_min;
        $user->save();
        return $user;
    }
}