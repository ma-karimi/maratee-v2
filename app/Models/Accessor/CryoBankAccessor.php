<?php


namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait CryoBankAccessor
{
    public function getSampleTypeAttribute()
    {
        return Arr::get(self::TYPE_SAMPLE, $this->sample_type_id);
    }
}
