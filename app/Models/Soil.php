<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soils';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'type', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'json',
        'description' => 'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];


    public function soilFeatures()
    {
        return $this->belongsToMany(SoilFeature::class,
            'soil_has_soil_features',
            'soil_id',
            'soil_feature_id');
    }

    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalGardenAction::class, ['from_soil_id', 'to_soil_id'])->latest();

    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicinalPlants()
    {
        return $this->hasMany('App\Models\MedicinalPlant');
    }
}
