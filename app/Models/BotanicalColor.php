<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalColor",
 *            required={"botanical_id", "botanical_general_id", "type_id"}
 *
 */
class BotanicalColor extends BaseModel
{

    public static $rules = [
        'type_id' => 'required|in:1,2,3',
        'botanical_id' => 'required|exists:botanicals,id',
        'botanical_general_id' => 'required|exists:botanical_generals,id',
    ];

}
