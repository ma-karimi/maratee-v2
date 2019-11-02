<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

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

    public const PLANT_CONDITION = [1 => 'full sun', 2 => 'light shade', 3 => 'moderate shade', 4 => 'deep shade', 5 => 'greenhouse', 6 => 'fancing N', 7 => 'fancing W', 8 => 'fancing S', 9 => 'fancing E'];

    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'planting_condition_id' => 'required|integer',
    ];

        protected $appends = ['planting_condition'];
    public function getPlantConditionAttribute()
    {
        return !empty($this->attributes['plant_condition_id']) ? Arr::get(self::PLANT_CONDITION, $this->attributes['plant_condition_id']) : null;
    }


}
