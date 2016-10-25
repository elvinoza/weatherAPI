<?php

namespace App\Http\Controllers;

use App\Services\NotifyService;

class NotifyController extends Controller
{
    protected $notifyService;

    public function __construct(NotifyService $notifyService)
    {
        $this->middleware('jwt.auth');
        $this->notifyService = $notifyService;
    }

    public function getNotification($id)
    {
        return $this->notifyService->getNotification($id);
    }

    public function decreaseUserNotificationsCount($userId)
    {
        return $this->notifyService->decreaseCount($userId);
    }

    public function setAsRead($id)
    {
        return $this->notifyService->setAsRead($id);
    }
}