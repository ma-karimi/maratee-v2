<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PlantGeographical",
 *      required={"plant_id","geographical_id"}
 * )
 */

class PlantGeographical extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_geographicals';


    public static $rules = [
        'plant_id' => 'required|exists:plants,id',
        'geographical_id' => 'required|exists:geographical,id'
    ];
}
