<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Requests\Auth\ChangeUserPasswordRequest;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('jwt.auth', ['except' => ['createUser']]);
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        return $this->userService->createUser($request);
    }

    public function getUser($id)
    {
        return $this->userService->getUser($id);
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        return $this->userService->update($id, $request);
    }

    public function changeUserPassword(ChangeUserPasswordRequest $request)
    {
        return $this->userService->changeUserPassword($request);
    }

    public function getUserStations($id)
    {
        return $this->userService->getUserStations($id);
    }

    public function getUserStationsLastData($id)
    {
        return $this->userService->getUserStationsLastData($id);
    }

    public function getUserDiseaseModels($id)
    {
        return $this->userService->getUserDiseaseModels($id);
    }
}
