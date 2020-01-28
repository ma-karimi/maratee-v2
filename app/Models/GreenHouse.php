<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="GreenHouse",
 *      required={"name_en"},
 * )
 */
class GreenHouse extends BaseModel
{

    public static $rules = [
        'name_en' => 'required|string',
        'location' => 'location|array'
    ];
    protected $with = ['location'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
