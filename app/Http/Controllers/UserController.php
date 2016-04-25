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
        $this->stationService = $userService;
    }

    public function getUser($id)
    {
        return $this->stationService->getUser($id);
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        return $this->stationService->update($id, $request);
    }
}
