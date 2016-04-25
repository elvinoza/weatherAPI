<?php

namespace App\Repositories;

interface IStationRepository
{
    public function index();
    public function save($inputs, $user_id);
}