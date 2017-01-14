<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseModel extends Model
{
    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'has_conditions'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'disease_models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'solution', 'user_id'
    ];

    public function conditions()
    {
        return $this->hasMany('App\Models\DiseaseCondition');
    }

    function getHasConditionsAttribute() {
        if (is_null($this->conditions()->first())) {
            return false;
        }

        return true;
    }
}