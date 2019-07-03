<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotanicalGardenAction extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_garden_action';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'date', 'deleted_at', 'destination_place_condition', 'destination_place_type', 'garden_id', 'garden_id1', 'initial_place_condition', 'initial_place_type', 'lighting_id', 'lighting_id1', 'person_id', 'planting_action_id', 'soil_id', 'soil_id1', 'status_id', 'treatment', 'updated_at'];

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
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

}
