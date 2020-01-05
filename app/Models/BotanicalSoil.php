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
        'soil_types' => 'required'
    ];

    protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo(BotanicalGeneral::class);
    }
}
