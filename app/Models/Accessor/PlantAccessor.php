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
    public function getScientificNameAttribute()
    {
        return [
            'genus_name' => !empty($this->taxonomy->genus) ? $this->taxonomy->genus->name : null,
            'species_name' => !empty($this->taxonomy->species) ? $this->taxonomy->species->name : null,
            'subspecies_name' => !empty($this->taxonomy->subspecies) ? $this->taxonomy->subspecies->name : null,
            'variety_name' => !empty($this->taxonomy->variety) ? $this->taxonomy->variety->name : null,
        ];
    }

    public function getFloweringTimeAttribute($value)
    {
        return Arr::get(self::FLOWERING_TIME, $value);
    }
}
