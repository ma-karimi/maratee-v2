<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="CryobankGeneral",
 *      required={"name"},
 *     }
 */
class CryobankGeneral extends BaseModel
{

    public static $rules = [
        'name' => 'required|string',
        'type' => 'required|string'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
