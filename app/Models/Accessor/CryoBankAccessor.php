<?php


namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait CryoBankAccessor
{
    public function getSampleTypeAttribute()
    {
        return Arr::get(self::TYPE_SAMPLE, $this->sample_type_id);
    }

    public function getSampleAttribute()
    {
        return Arr::get(self::SAMPLE, $this->sample_type_id);
    }

    public function getGenotypeCodeAttribute()
    {
        return $this->year . $this->sample . $this->tank . $this->rack . $this->box . $this->cell;
    }
}
