<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Herbariums extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbariums';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'flowering', 'herbarium_tip_location', 'is_flowering', 'location_id', 'name', 'number', 'organization_description', 'organization_id', 'phenology_id', 'physical_tip_qt', 'phytogeography_id', 'plant_group_id', 'plant_type_id', 'protection_id', 'samples_no', 'sheets_no', 'tip_qt', 'tip_type', 'type_description', 'updated_at'];

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
