<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilHasSoilFeatures extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soil_has_soil_features';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'soil_feature_id', 'soil_id', 'updated_at', 'value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'value'=>'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function soilFeature()
    {
        return $this->belongsTo(SoilFeatures::class, 'soil_feature_id');
    }

    public function soil()
    {
        return $this->belongsTo(Soils::class, 'soil_id');
    }
}
