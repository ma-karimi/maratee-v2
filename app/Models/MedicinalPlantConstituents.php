<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class MedicinalPlantConstituents extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plant_constituents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['constituent_id', 'created_at', 'deleted_at', 'medicinal_plant_id', 'updated_at', 'value'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];



}
