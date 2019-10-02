<?php

namespace App\Models\Convert;


class Treeleaf extends BaseModel
{
    protected $table = 'treeleaf';

    public function city()
    {
        return City::find($this->attributes['city']);
    }

    public function hasCity()
    {
        return $this->city() instanceof City;
    }
}
