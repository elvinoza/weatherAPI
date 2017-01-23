<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Station extends Model {

    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'is_active',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location', 'update_time', 'isValid', 'app_key', 'lat', 'lng'
    ];

    /**
     * Many to one relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongTo
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function weathers()
    {
        return $this->hasMany('App\Models\Weather');
    }

    public function forecasts()
    {
        return $this->hasMany('App\Models\Forecast')->where('date', '=', Carbon::now())->where('date', '=', Carbon::now()->addDay());
    }

    public function settings()
    {
        return $this->hasMany('App\Models\NotificationSettings');
    }

    public function getIsActiveAttribute()
    {
        return !Helper::CompareDateFromNow($this->last_data_time, 24);
    }
}