<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait MediaAccessor
{
    public function getMediaTypeAttribute($value)
    {
        return Arr::get(self::MEDIA_TYPE, $value);
    }
    public function getFullUrlAttribute()
    {
        return $this->getFullUrl();
    }
}
