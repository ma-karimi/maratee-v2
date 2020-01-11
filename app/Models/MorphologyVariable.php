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
    public static $rules = [
        'variable_id' => 'required|exists:variables,id',
    ];
}
