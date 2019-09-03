<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


trait PlantAccessor
{
    public function getScientificNameAttribute()
    {
        return [
            'genus_name' => $this->taxonomy->genus->name,
            'species_name' => $this->taxonomy->species->name,
            'subspecies_name' => $this->taxonomy->subspecies->name,
            'variety_name' => $this->taxonomy->variety->name,
        ];
    }
}