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

    public const TYPE = [1 => 'Value', 2 => 'Usage', 3 => 'Propagation', 4 => 'Plant Condition', 5 => 'Cycle', 6 => 'Color', 7=>'Origin'];


    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string',
    ];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->attributes['type_id']);
    }

    protected $appends = ['type'];

}
