<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MedicinalLocationHub",
 *      required={"medicinal_location_id","hub_id", "hub_type"}
 * )
 */
class MedicinalLocationHub extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
