<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedEvaluation",
 * )
 */
class SeedEvaluation extends BaseModel
{


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
}
