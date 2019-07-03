<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantApplication extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_application';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['application_id', 'created_at', 'deleted_at', 'herbarium_id', 'industry_id', 'person_id', 'plant_part_id', 'presence', 'status_id', 'updated_at', 'usage_type_id'];

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
