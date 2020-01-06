<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalSoil",
 *            required={"botanical_id", "general_id", "value"},
 *        )
 **/
class BotanicalSoil extends BaseModel
{

    public static $rules = [
        'soil_id' => 'required|exists:botanical_generals,id',
        'soil_types' => 'required',
        'soil_types.*.general_id' => 'required|exists:botanical_generals,id',
        'soil_types.*.value' => 'required',
    ];

    protected $with = ['general'];

    public function general()
    {
        return $this->belongsTo(BotanicalGeneral::class);
    }
}
