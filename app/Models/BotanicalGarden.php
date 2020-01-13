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
    protected $with = ['entrances'];
    protected $appends = ['entrance'];
    public function entrances()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_garden_entrances', 'botanical_garden_id', 'general_id')->where('botanical_generals.type_id', 12)->whereNull('botanical_garden_entrances.deleted_at')->withTimestamps();
    }

    public function internalHabitat()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'internal_habitat_id')->where('botanical_generals.type_id', 20);
    }

    public function garden()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'garden_id')->where('botanical_generals.type_id', 19);
    }

    public function getEntranceAttribute()
    {
        $item = null;
        if ($this->relationLoaded('entrances') && count($this->entrances)) {
            $item .= $this->entrances->implode('name', ' & ');
        }

        return $item;
    }
}
