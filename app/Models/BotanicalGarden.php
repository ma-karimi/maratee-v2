<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalGarden",
 *            required={"botanical_id", "internal_habitat_id", "garden_id"},
 *        )
 **/
class BotanicalGarden extends BaseModel
{
    public function entrances()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_garden_entrances', 'botanical_garden_id','general_id')->where('botanical_generals.type_id', 12)->whereNull('botanical_garden_entrances.deleted_at')->withTimestamps();
    }

    protected $with = ['entrances'];
}
