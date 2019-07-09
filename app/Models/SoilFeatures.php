<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilFeatures extends Model  
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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function soils()
    {
        return $this->belongsToMany(Soils::class,
            'soil_has_soil_features',
            'soil_feature_id',
            'soil_id');
    }

}
