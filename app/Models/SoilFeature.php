<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SoilFeature extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soil_features';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'name', 'unit', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'unit' => 'json'
    ];


    public function soils()
    {
        return $this->belongsToMany(Soil::class,
            'soil_has_soil_features',
            'soil_feature_id',
            'soil_id');
    }

}
