<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait TransactionHubAccessor
{
    public function getTypeIdAttribute($value)
    {
        return Arr::get(self::TYPE, $value);
    }
}
