<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\UserNotify;

interface INotifyService
{
    function getNotification($id);
    function crateNotification($userId, $diseaseModelId, $shortMessage, $fullMessage);
    function setAsRead($id);
    function decreaseCount($userId);
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

    public function crateNotification($userId, $diseaseModelId, $shortMessage, $fullMessage)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->disease_model_id = $diseaseModelId;
        $notification->short_message = $shortMessage;
        $notification->full_message = $fullMessage;
        $notification->is_viewed = false;
        $notification->is_read = false;
        $notification->is_valid = true;
        $notification->save();

        $this->increaseUserNotificationsCount($userId);

        return $notification;
    }

    public function setAsRead($id)
    {
        $notification = $this->notification->find($id);
        $userNotify = $this->userNotify->where('user_id', $notification->user_id)->first();

        if ($notification->is_read) {
            return $userNotify->count;
        }

        $notification->is_read = true;
        $userNotify->count--;
        $notification->save();
        $userNotify->save();

        return $userNotify->count;
    }

    public function decreaseCount($userId)
    {
        $userNotify = $this->userNotify->where('user_id', $userId)->first();
        $userNotify->count--;
        $userNotify->save();

        return $userNotify->count;
    }

    private function increaseUserNotificationsCount($userId) {
        if ($userNotify = $this->userNotify->where('user_id', $userId)->first()){
            $userNotify->count++;
            $userNotify->is_viewed = false;
        } else {
            $userNotify = new UserNotify();
            $userNotify->user_id = $userId;
            $userNotify->count = 1;
        }

        $userNotify->save();
    }
}