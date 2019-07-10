<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class PlantApplication extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_applications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['application_id', 'created_at', 'deleted_at', 'herbarium_id', 'plant_growth_id', 'plant_industry_id', 'plant_part_id', 'plant_usage_type_id', 'presence', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'presence'=>'json'
    ];



}
