<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Botanicals extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'entry_type', 'first_flowering', 'first_seeding', 'flower_color', 'flowring_interval', 'fruit_color', 'growth_rate', 'height', 'herbarium_id', 'leaf_color', 'notes', 'planting', 'scion_rooting_per', 'season_resistance', 'seed_production', 'seed_value', 'sensitivity', 'sensitivity_description', 'sprout', 'treatment', 'updated_at', 'year'];

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
    protected $dates = ['created_at', 'deleted_at', 'planting', 'updated_at', 'year'];

}
