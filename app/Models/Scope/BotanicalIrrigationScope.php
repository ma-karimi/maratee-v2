<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


trait BotanicalIrrigationScope
{
    /**
     * @param $query
     * @param $season
     * @return mixed
     */
    public function scopeOfSeason($query, $season)
    {
        return $query->where('season_feature', 'LIKE', "%{$season}%");
    }
}
