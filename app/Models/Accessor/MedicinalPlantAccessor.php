<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait MedicinalPlantAccessor
{


    public function getWoodenAttribute()
    {
        return !empty($this->wooden_id) ? Arr::get(self::WOODEN, $this->wooden_id) : null;
    }

    public function getHerbaceousAttribute()
    {
        return !empty($this->herbaceous_id) ? Arr::get(self::HERBACEOUS, $this->herbaceous_id) : null;
    }

    public function getAerialTypeAttribute()
    {
        $item = null;

        if ($this->relationLoaded('aerialTypes') && $this->aerialTypes->count()) {
            $item .= $this->aerialTypes->implode('name', ' & ');
        }
        return $item;
    }

    /**
     * @deprecated by dr.sefidkon
     * @return string|null
     */
    public function getMaterialsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('effectiveMaterials') && $this->effectiveMaterials->count()) {
            $item .= $this->effectiveMaterials->implode('name', ' & ');
        }
        return $item;
    }

    public function getMedicinalPropertiesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('properties') && $this->properties->count()) {
            $item .= $this->properties->implode('name', ' & ');
        }
        return $item;
    }


    public function getMetabolitesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('secondaryMetabolites') && $this->secondaryMetabolites->count()) {
            $item .= $this->secondaryMetabolites->implode('name', ' & ');
        }
        return $item;
    }
}
