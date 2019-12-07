<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPartAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MedicinalPart",
 *      required={"name","type"}
 * )
 */
class MedicinalPart extends BaseModel
{
    use MedicinalPartAccessor;

    public const TYPE = [1 => 'aerial', 2 => 'ground'];

    public static $rules = [
        'name' => 'required|string',
        'type_id' => 'required|integer',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
