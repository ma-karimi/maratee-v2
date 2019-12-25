<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait BotanicalIrrigationAccessor
{
    public function getIrrigationTimeAttribute()
    {
        return !empty($this->irrigation_time_id) ? Arr::get(self::IRRIGATION_TIME, $this->irrigation_time_id) : null;
    }

    public function getRequirementAttribute()
    {
        return !empty($this->requirement_id) ? Arr::get(self::REQUIREMENT, $this->requirement_id) : null;
    }

    public function getIrrigationAttribute()
    {
        return !empty($this->irrigation_id) ? Arr::get(self::IRRIGATIONS, $this->irrigation_id) : null;
    }
}
