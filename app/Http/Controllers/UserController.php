<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdateUserRequest;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
        $this->userService = $userService;
    }

    public function getUser($id)
    {
        return $this->userService->getUser($id);
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        return $this->userService->update($id, $request);
    }

    public function getUserStations($id)
    {
        return $this->userService->getUserStations($id);
    }

    public function getUserStationsLastData($id)
    {
        return $this->userService->getUserStationsLastData($id);
    }
}
