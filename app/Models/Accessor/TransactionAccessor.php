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
    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->attributes['type_id']);
    }

    public function getVisitAttribute()
    {
        return Arr::get(self::VISIT, $this->attributes['visit_id']);
    }

    public function getModeAttribute()
    {
        return Arr::get(self::Mode, $this->attributes['mode_id']);
    }
}
