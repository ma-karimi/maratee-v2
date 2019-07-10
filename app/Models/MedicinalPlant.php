<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class MedicinalPlant extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['acidity', 'article_id', 'code_no', 'created_at', 'deleted_at', 'efficiency', 'exclusivity', 'herbarium_id', 'life_cycle', 'location_id', 'media_id', 'method_id', 'plant_origin_id', 'secondary_metabolite', 'soil_id', 'studied_sample', 'treatment', 'updated_at', 'vast_cultivation'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];



}
