<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedTechnology extends BaseModel
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
    protected $casts = [
        'seed_type' => 'json',
        'type' => 'json',
        'description' => 'json',
    ];

    public function technologyCollections()
    {
        return $this->hasMany(TechnologyCollection::class, 'seed_technology_id');
    }

    public function seedWeights()
    {
        return $this->hasMany(SeedWeight::class, 'seed_technology_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }
}
