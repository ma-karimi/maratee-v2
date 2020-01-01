<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="BotanicalColorHub",
 *            required={"botanical_id", "botanical_general_id", "type_id"}
 *
 */
class BotanicalColorHub extends BaseModel
{
    
    public static $rules = [
        'type_id' => 'required|in:1,2,3',
        'botanical_id' => 'required|exists:botanicals,id',
        'botanical_general_id' => 'required|exists:botanical_generals,id',
    ];

}
