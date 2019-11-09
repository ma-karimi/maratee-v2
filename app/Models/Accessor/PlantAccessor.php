<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait PlantAccessor
{

    public function getMonopolyOfIranAttribute()
    {
        return !empty($this->attributes['monopoly_of_iran_id']) ? Arr::get(self::BOOLEAN, $this->attributes['monopoly_of_iran_id']) : null;
    }

    public function getPlantGeographicalsAttribute()
    {
        if($this->relationLoaded('geographicals') &&  !empty($this->geographicals)){
            return implode(', ', $this->geographicals()->pluck('name')->toArray());
        }
    }
    public function getLifeFormAttribute()
    {
            return !empty($this->attributes['life_form_id']) ? Arr::get(self::LIFE_FORM, $this->attributes['life_form_id']) : null;
    }
}
