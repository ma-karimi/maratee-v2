<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedMolecular extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_moleculars';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'location_id', 'molecular_id', 'repeat', 'seed_id', 'treatment', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function molecular()
    {
        return $this->belongsTo(Molecular::class, 'molecular_id');
    }

    public function seed()
    {
        return $this->belongsTo(Seed::class, 'seed_id');
    }

}
