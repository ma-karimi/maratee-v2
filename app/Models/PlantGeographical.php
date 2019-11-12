<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PlantGeographical",
 *      required={"plant_id","geographical_ids"}
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
//        'geographical_ids' => 'required|array',
        'geographical_ids.*' => 'required|exists:geographicals,id'
    ];
}
