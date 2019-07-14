<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Locality extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'fauna', 'formation', 'layer', 'lithology', 'location_id', 'map_id', 'paleontology_id', 'stratigraphy', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'formation' => 'json',
        'layer' => 'json',
        'stratigraphy' => 'json',
        'fauna' => 'json',
        'description' => 'json',
        'lithology' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    /**
     * @return BelongsTo
     */
    public function paleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class);
    }

}
