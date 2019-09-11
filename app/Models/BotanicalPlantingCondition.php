<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalPlantingCondition",
 *            required={"botanical_id", "planting_condition_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="planting_condition_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalPlantingCondition extends BaseModel
{

    /*public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'planting_condition_id' => 'required|exists:planting_conditions,id',
    ];*/


}
