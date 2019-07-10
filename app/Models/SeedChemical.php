<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeedChemical extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_chemicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['chemical_id', 'created_at', 'deleted_at', 'location_id', 'repeat', 'seed_id', 'treatment', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function chemical()
    {
        return $this->belongsTo('App\Models\Chemical');
    }

    /**
     * @return BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }


}
