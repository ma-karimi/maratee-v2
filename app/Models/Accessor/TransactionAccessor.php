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
        return !empty($this->attributes['type_id']) ? Arr::get(self::TYPE, $this->attributes['type_id']) : null;
    }

    public function getVisitAttribute()
    {
        return !empty($this->attributes['visit_id']) ? Arr::get(self::VISIT, $this->attributes['visit_id']) : null;
    }

    public function getModeAttribute()
    {
        return !empty($this->attributes['mode_id']) ? Arr::get(self::MODE, $this->attributes['mode_id']) : null;
    }


    public function getSampleImpressionAttribute()
    {
        return !empty($this->attributes['mode_id']) && (int)$this->attributes['mode_id'] ? Arr::get(self::BOOLEAN, $this->attributes['sample_impression_id'] ?? 0) : null;
    }
}
