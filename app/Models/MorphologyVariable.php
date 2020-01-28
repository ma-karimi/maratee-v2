<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="MorphologyVariable",
 *            required={"variable_id","value"}
 */
class MorphologyVariable extends BaseModel
{


    public function seedGeneral()
    {
        return $this->belongsTo(SeedGeneral::class, 'seed_general_id');
    }

}
