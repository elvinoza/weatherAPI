<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model {

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
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function weathers()
    {
        return $this->hasMany('App\Models\Weather');
    }
}