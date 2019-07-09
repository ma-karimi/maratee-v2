<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Medicals extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'drug_description', 'drug_shape_description', 'drug_usage_description', 'herbarium_id', 'medicinal_part_description', 'medicine_drug_id', 'medicine_drug_shape_id', 'medicine_drug_usage_id', 'medicine_effect_description', 'medicine_effect_id', 'medicine_medicinal_part_id', 'medicine_side_effect_id', 'medicine_therapy_id', 'product_id', 'side_effect_description', 'therapy_description', 'updated_at'];

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
    protected $casts = [];



}
