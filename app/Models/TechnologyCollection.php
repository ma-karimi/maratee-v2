<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class TechnologyCollection extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'technology_collections';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['collection_id', 'created_at', 'deleted_at', 'seed_technology_id', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];



    public function seedTechnology()
    {
        return $this->belongsTo(SeedTechnology::class, 'seed_technology_id');
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

}
