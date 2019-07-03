<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medical';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'drug_description', 'drug_id', 'drug_shape_id', 'drug_usage_id', 'herbarium_id', 'medicinal_part_id', 'medicine_effect_descrition', 'medicine_effect_id', 'medicine_side_effect_id', 'person_id', 'product_id', 'side_effect_description', 'status_id', 'therapy_description', 'therapy_id', 'updated_at'];

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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

}
