<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedEvaluation",
 * )
 */
class SeedEvaluation extends BaseModel implements HasMedia
{

    use HasMediaTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_evaluations';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class);
    }

    public function radicals()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 1);
    }

    public function shoots()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 2);
    }

    public function lengths()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 3);
    }

    public function widths()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 4);
    }

    public function germinations()
    {
        return $this->hasMany(GerminationNumber::class);
    }
}
