<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait TransactionAccessor
{
    public function getTypeNameAttribute()
    {
        $value= $this->attributes['type_id'];
        return Arr::get(self::TYPE, $value);
    }

    public function getVisitAttribute($value)
    {
        return Arr::get(self::VISIT, $value);
    }
}
