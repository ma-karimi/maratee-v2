<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedWeight extends BaseModel
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'json'
    ];


    public function seedTechnology()
    {
        return $this->belongsTo(SeedTechnology::class, 'seed_technology_id');
    }

}
