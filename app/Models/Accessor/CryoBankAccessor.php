<?php


namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait CryoBankAccessor
{
    public function getSampleTypeAttribute()
    {
        return Arr::first(self::TYPE_SAMPLE, function ($q){
            return $q['id'] == $this->sample_type_id;
        });
    }
}
