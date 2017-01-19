<?php

namespace App\Services;

use App\Enums\ClsfWeatherParameters;
use App\Enums\CompareOperators;
use App\Helpers\Helper;
use App\Models\NotificationSettings;

interface INotificationSettingsService
{
    function getSettings($id);
    function update($data);
    function checkForNotifications($data);
}

class NotificationSettingsService implements INotificationSettingsService
{
    protected $notifyService;
    protected $stationService;
    protected $notificationSettings;

    public function __construct(
        NotifyService $notifyService,
        StationService $stationService,
        NotificationSettings $notificationSettings)
    {
        $this->notifyService = $notifyService;
        $this->stationService = $stationService;
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

    public function checkForNotifications($data)
    {
        $stationSettings = $this->getTurnedOnStationSettings($data->station_id);
        $station = $this->stationService->getStation($data->station_id);
        $stationUser = $this->stationService->getUserByStation($data->station_id);

        foreach($stationSettings as $setting)
        {
            $message = $this->checkParameter($setting, $data, $station->name);

            if ($message != null && ($setting->last_notification_date == null || Helper::compareDatesForNotification($setting->last_notification_date))) {
                $this->notifyService->crateNotification($stationUser->id, 0, "Detected comparison by station(" . $station->name . ") settings", $message);
                $this->updateSettingLastNotificationDate($setting->id);
            }
        }
    }

    private function getTurnedOnStationSettings($stationId)
    {
        return $this->notificationSettings->where('station_id', $stationId)->where('is_active', true)->get();
    }

    private function checkParameter($setting, $data, $stationName)
    {
        switch ($setting->clsf_weather_parameter)
        {
            case ClsfWeatherParameters::Temperature:
                if ($this->compare($setting->value, $data->temperature, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->temperature, "temperature", "C");

                break;
            case ClsfWeatherParameters::Humidity:
                if ($this->compare($setting->value, $data->humidity, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->humidity, "humidity", "%");

                break;
            case ClsfWeatherParameters::Pressure:
                if ($this->compare($setting->value, $data->pressure, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->pressure, "pressure", "Pa");

                break;
            case ClsfWeatherParameters::SoilTemperature:
                if ($this->compare($setting->value, $data->soil_temperature, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->soil_temperature, "soil temperature", "C");

                break;
            case ClsfWeatherParameters::SoilHumidity:
                if ($this->compare($setting->value, $data->soil_humidity, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->soil_humidity, "soil humidity", "%");

                break;
            case ClsfWeatherParameters::WindSpeed:
                if ($this->compare($setting->value, $data->wind_speed, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->wind_speed, "wind speed", "m/s");

                break;
            case ClsfWeatherParameters::Rain:
                if ($this->compare($setting->value, $data->rain, $setting->compare_operator))
                    return Helper::formatNotificationMessage($stationName, $data->rain, "rain", "mm");

                break;
            default:
                if ($setting->value == $data->wind_direction)
                    return Helper::formatNotificationMessage($stationName, $data->wind_direction, "wind direction", "");

                break;
        }

        return null;
    }

    private function compare($settingValue, $dataValue, $operator){
        if ($operator == CompareOperators::LessThan)
            return ($dataValue <= $settingValue);
        else
            return ($dataValue >= $settingValue);
    }

    private function updateSettingLastNotificationDate($id)
    {
        $setting = $this->notificationSettings->find($id);
        $setting->last_notification_date = date("Y-m-d H:m:s");
        $setting->save();
    }
}