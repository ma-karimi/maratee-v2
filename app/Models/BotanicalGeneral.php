<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="BotanicalGeneral",
 *            required={"name", "type_id"}
 *
 */
class BotanicalGeneral extends BaseModel
{

    public const TYPE = [
        1 => 'Value', 2 => 'Usage', 3 => 'Propagation', 4 => 'Plant Condition', 5 => 'Cycle', 6 => 'Color', 7 => 'Origin', 8 => 'GROWTH RATE', 9 => 'Seed Rate', 10 => 'Winter Tolerance', 11 => 'Summer Tolerance', 12 => 'Entrance From To Garden', 13 => 'Soil', 14 => 'Wooden', 15 => 'Seed Germination', 16 => 'Habitat', 17 => 'Soil Type', 18 => 'Collection'
    ];


    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string',
    ];
    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->attributes['type_id']);
    }

}
