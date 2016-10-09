<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\UserNotify;

interface INotifyService
{
    function getNotification($id);
}

class NotifyService implements INotifyService
{
    protected $notification;
    protected $userNotify;

    public function __construct(Notification $notification, UserNotify $userNotify)
    {
        $this->notification = $notification;
        $this->userNotify = $userNotify;
    }

    public function getNotification($id)
    {
        return $this->notification->find($id);
    }
}