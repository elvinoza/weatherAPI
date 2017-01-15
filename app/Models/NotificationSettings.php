<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'station_id',
        'clsf_weather_parameter',
        'compare_operator',
        'value',
        'is_active',
        'is_valid'
    ];

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }
}