<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedTechnologies extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_technologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['abnormality', 'created_at', 'deleted_at', 'description', 'examine', 'hard_seed', 'humidity', 'husk_average', 'husk_weight', 'purity', 'seed_id', 'seed_type', 'seed_weight', 'sprout', 'type', 'updated_at', 'vigor'];



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
    protected $dates = ['created_at', 'deleted_at', 'examine', 'updated_at'];

}
