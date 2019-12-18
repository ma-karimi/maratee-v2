<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait MedicinalLocationAccessor
{


    public function getStudiedSampleNameAttribute()
    {
        return Arr::get(self::STUDIED_SAMPLE, $this->studied_sample);
    }

    public function getPresenceInCountryNameAttribute()
    {
        return Arr::get(self::PRESENCE_IN_COUNTRY, $this->presence_in_country);
    }


    public function getMetabolitesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('secondaryMetabolites') &&  $this->secondaryMetabolites->count()) {
            $item .= $this->secondaryMetabolites->implode('name', ' & ');
        }
        return $item;
    }

}
