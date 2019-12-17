<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MedicinalHub",
 *      required={"medicinal_plant_id","hub_id", "hub_type"}
 * )
 */
class MedicinalHub extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
