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
    public function getAppropriateIrrigationTimeAttribute($value)
    {
        return Arr::get(self::IRRIGATION_TIME, $value);
    }
    public function getRequirementAttribute($value)
    {
        return Arr::get(self::REQUIREMENT, $value);
    }
}
