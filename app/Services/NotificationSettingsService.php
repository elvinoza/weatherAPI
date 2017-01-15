<?php

namespace App\Services;

use App\Models\NotificationSettings;

interface INotificationSettingsService
{
    function getSettings($id);
    function update($data);
}

class NotificationSettingsService implements INotificationSettingsService
{
    protected $notificationSettings;

    public function __construct(NotificationSettings $notificationSettings)
    {
        $this->notificationSettings = $notificationSettings;
    }

    public function getSettings($id)
    {
        return $this->notificationSettings->where('station_id', '=', $id)->get();
    }

    public function update($data)
    {
        $id = 0;
        $settings = json_decode($data->getContent());

        foreach($settings as $setting)
        {
            $id = $setting->station_id;
            $notificationSetting = $this->notificationSettings->find($setting->id);

            if ($notificationSetting != null) {

                $notificationSetting->station_id = $setting->station_id;
                $notificationSetting->clsf_weather_parameter = $setting->clsf_weather_parameter;
                $notificationSetting->compare_operator = $setting->compare_operator;
                $notificationSetting->value = $setting->value;
                $notificationSetting->is_active = $setting->is_active;
                $notificationSetting->is_valid = $setting->is_valid;
                $notificationSetting->save();
            } else {
                $notificationSetting = new NotificationSettings();
                $notificationSetting->station_id = $setting->station_id;
                $notificationSetting->clsf_weather_parameter = $setting->clsf_weather_parameter;
                $notificationSetting->compare_operator = $setting->compare_operator;
                $notificationSetting->value = $setting->value;
                $notificationSetting->is_active = $setting->is_active;
                $notificationSetting->is_valid = $setting->is_valid;
                $notificationSetting->save();
            }
        }

        return $this->getSettings($id);
    }
}