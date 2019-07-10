<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Geramin extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geramins';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['average', 'big_bush_diameter', 'bush', 'bush_height', 'bush_weight', 'collection_id', 'created_at', 'crown_coverage', 'deleted_at', 'essence_rate', 'flower_color', 'flowering_bish_qt', 'flowering_completion', 'gdd_flowering', 'repeat', 'seed_id', 'small_bush_diameter', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['flower_color'=>'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'flowering_completion', 'gdd_flowering', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * @return BelongsTo
     */
    public function seed(): BelongsTo
    {
        return $this->belongsTo(Seed::class);
    }
}
