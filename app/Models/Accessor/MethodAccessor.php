<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait MethodAccessor
{
    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->type_id);
    }
}
