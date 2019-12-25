<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait SeedGeneralAccessor
{
    public function getTypeAttribute()
    {
        if (isset($this->attributes['type_id'])) {
            return Arr::get(self::TYPE, $this->attributes['type_id']);
        }
    }
}
