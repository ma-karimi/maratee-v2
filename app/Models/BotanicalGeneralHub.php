<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="BotanicalGeneralHub",
 *            required={"botanical_id", "botanical_general_id"}
 *
 */
class BotanicalGeneralHub extends BaseModel
{

    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string',
    ];

}
