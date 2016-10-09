<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'disease_model_id', 'short_message', 'full_message', 'is_viewed', 'is_read', 'is_valid'
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

    public function diseaseModel()
    {
        return $this->belongsTo('App\Models\DiseaseModel');
    }
}