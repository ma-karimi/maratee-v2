<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Treatment",
 *      required={"name_en"}
 * )
 */
class Treatment extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'treatments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'date'];



    public static $rules = [
        'name_en' => 'required|string',
        'description' => 'string'
    ];



    public function treatmentHubs()
    {
        return $this->morphedByMany(TreatmentHub::class, 'treatmentable');
    }
}
