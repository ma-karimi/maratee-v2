<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedWeights extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'active_revival', 'base', 'base_revival', 'created_at', 'deleted_at', 'description', 'revival_code', 'seed_technology_id', 'support', 'support_revival', 'total', 'updated_at'];

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
