<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationSettings\UpdateNotificationsSettingsRequest;
use App\Services\NotificationSettingsService;

class NotificationSettingsController extends Controller
{
    protected $notificationSettingsService;

    public function __construct(NotificationSettingsService $notificationSettingsService)
    {
        $this->middleware('jwt.auth');
        $this->notificationSettingsService = $notificationSettingsService;
    }

    public function getSettings($id)
    {
        return $this->notificationSettingsService->getSettings($id);
    }

    public function update(UpdateNotificationsSettingsRequest $request)
    {
        return $this->notificationSettingsService->update($request);
    }


}
