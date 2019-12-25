<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait ProductAccessor
{
    public function getTypeAttribute($value)
    {
        return Arr::get(self::STATUS, $value);
    }

    public function getStatusNameAttribute()
    {
        if (isset($this->attributes['registration_status'])) {
            return Arr::get(self::STATUS, $this->attributes['registration_status']);
        }
    }
}
