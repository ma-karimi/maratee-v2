<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait HerbariumAccessor
{

    public function getGrowthRateAttribute($value)
    {
        return Arr::get(self::GROWTH_RATES, $value);
    }
}
