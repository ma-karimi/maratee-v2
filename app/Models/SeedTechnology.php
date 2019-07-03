<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedTechnology extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_technology';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['abnormality', 'created_at', 'deleted_at', 'descriptions', 'examine', 'hard_seed', 'humidity', 'husk_average', 'husk_weight', 'person_id', 'purity', 'seed_id', 'seed_type', 'seed_weight', 'sprout', 'status_id', 'type', 'updated_at', 'vigor'];

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
    protected $dates = ['created_at', 'deleted_at', 'examine', 'updated_at'];

}
