<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotify extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_notify';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'count', 'is_viewed'
    ];

    /**
     * Many to one relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongTo
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}