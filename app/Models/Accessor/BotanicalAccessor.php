<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait BotanicalAccessor
{

    public function getMonopolyOfIranAttribute()
    {
        return !empty($this->attributes['monopoly_of_iran_id']) ? Arr::get(self::BOOLEAN, $this->attributes['monopoly_of_iran_id']) : null;
    }

    public function getEntranceToGardenAttribute()
    {
        return !empty($this->attributes['entrance_to_garden_id']) ? Arr::get(self::ENTRANCE_TO_GARDEN, $this->attributes['entrance_to_garden_id']) : null;
    }

    public function getSoilAttribute()
    {
        return !empty($this->attributes['soil_id']) ? Arr::get(self::SOIL, $this->attributes['soil_id']) : null;
    }

    public function getGrowthRateAttribute()
    {
        return !empty($this->attributes['growth_rate_id']) ? Arr::get(self::GROWTH_RATES, $this->attributes['growth_rate_id']) : null;
    }

    public function getSeedRateAttribute()
    {
        return !empty($this->attributes['seed_rate_id']) ? Arr::get(self::SEED_RATE, $this->attributes['seed_rate_id']) : null;
    }

    public function getSeedFormationAttribute()
    {
        return !empty($this->attributes['seed_formation_id']) ? Arr::get(self::GROWTH_RATES, $this->attributes['seed_formation_id']) : null;
    }

    public function getWinterToleranceAttribute()
    {
        return !empty($this->attributes['winter_tolerance_id']) ? Arr::get(self::WINTER_TOLERANCE, $this->attributes['winter_tolerance_id']) : null;
    }

    public function getSummerToleranceAttribute()
    {
        return !empty($this->attributes['summer_tolerance_id']) ? Arr::get(self::SUMMER_TOLERANCE, $this->attributes['summer_tolerance_id']) : null;
    }

    public function getWoodenAttribute()
    {
        return !empty($this->attributes['wooden_id']) ? Arr::get(self::WOODEN, $this->attributes['wooden_id']) : null;
    }

    public function getCycleAttribute()
    {
        return !empty($this->attributes['cycle_id']) ? Arr::get(self::CYCLE, $this->attributes['cycle_id']) : null;
    }

    public function getSeedGerminationAttribute()
    {
        return !empty($this->attributes['seed_germination_id']) ? Arr::get(self::SEED_GERMINATION, $this->attributes['seed_germination_id']) : null;
    }

}
