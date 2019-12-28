<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="BotanicalPeroperty",
 *            required={"botanical_id", "type_id", "property_id"}
 *
 */
class BotanicalProperty extends BaseModel
{

    public const USAGE = [1 => 'medicinal', 2 => 'ground cover', 3 => 'hedge', 4 => 'ornamental', 5 => 'industrial'];
    public const VALUE = [1 => 'Shape', 2 => 'Bark', 3 => 'leaves', 4 => 'autumn color', 5 => 'flower'];
    public const PROPAGATION = [1 => 'seed', 2 => 'cutting', 3 => 'graft', 4 => 'natural regeneration', 5 => 'root sucker', 6 => 'collar sprout'];
    public const TYPE = [1 => 'Value', 2 => 'Usage', 3 => 'Propagation', 4=>'Plant Condition', 5=>'Cycle'];

    public const PLANT_CONDITION = [1 => 'full sun', 2 => 'light shade', 3 => 'moderate shade', 4 => 'deep shade', 5 => 'greenhouse', 6 => 'fancing N', 7 => 'fancing W', 8 => 'fancing S', 9 => 'fancing E'];
    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'type_id' => 'required|integer',
        'property_id' => 'required|integer',
    ];
    public const CYCLE = [1 => 'evergreen', 2 => 'deciduous', 3 => 'semi deciduous', 4 => 'annual climber', 5 => 'perennial climber', 6 => 'annual herb', 7 => 'biennial herb', 8 => 'perennial herb', 9 => 'bulb', 10 => 'tuber', 11 => 'rhizome', 12 => 'water plant'];
    protected $appends = ['type', 'value', 'usage', 'propagation', 'plant_condition', 'cycle'];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->attributes['type_id']);
    }

    public function getValueAttribute()
    {
        return $this->type_id == 1 ? Arr::get(self::VALUE, $this->attributes['property_id']) : null;
    }

    public function getUsageAttribute()
    {
        return $this->type_id == 2 ? Arr::get(self::USAGE, $this->attributes['property_id']) : null;
    }
    public function getCycleAttribute()
    {
        return $this->type_id == 5 ? Arr::get(self::CYCLE, $this->attributes['property_id']) : null;
    }

    public function getPropagationAttribute()
    {
        return $this->type_id == 3 ? Arr::get(self::PROPAGATION, $this->attributes['property_id']) : null;
    }

    public function getPlantConditionAttribute()
    {
        return $this->type_id == 4 ? Arr::get(self::PLANT_CONDITION, $this->attributes['property_id']) : null;
    }


}
