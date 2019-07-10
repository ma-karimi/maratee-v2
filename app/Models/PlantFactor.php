<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\MedicinalPlant;

class PlantFactor extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_factors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'parent_id', 'type', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'=>'json',
        'description'=>'json'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicinalPlants()
    {
        return $this->hasMany(MedicinalPlant::class, 'plant_origin_id');
    }

}
