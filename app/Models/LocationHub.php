<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="LocationHub",
 *      required={"location_id", "locationable_id", "locationable_type"},
 * )
 */
class LocationHub extends BaseModel
{

    public static $rules = [
        'location_id' => 'required|exists:locations,id',
        'locationable_id' => 'required|integer',
        'locationable_type' => 'required'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location_hubs';
    protected $with = ['location'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
