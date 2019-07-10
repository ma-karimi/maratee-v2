<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeedHasPlant extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_has_plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'plant_id', 'seed_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }

}
