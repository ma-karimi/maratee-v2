<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
