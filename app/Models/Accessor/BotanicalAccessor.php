<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait BotanicalAccessor
{

    public function getMonopolyOfIranAttribute()
    {
        return !empty($this->attributes['monopoly_of_iran_id']) ? Arr::get(self::BOOLEAN, $this->attributes['monopoly_of_iran_id']) : null;
    }

    public function getCycleAttribute()
    {
        $cycles = null;

        if ($this->relationLoaded('cycles') && $this->cycles->count()) {
            $cycles .= $this->cycles->implode('name', ' & ');
        }
        return $cycles;
    }

    public function getInternalHabitatAttribute()
    {
        $internalHabitats = null;

        if ($this->relationLoaded('internalHabitats') && $this->internalHabitats->count()) {
            $internalHabitats .= $this->internalHabitats->implode('name', ' & ');
        }
        return $internalHabitats;
    }

    public function getGardenAttribute()
    {
        $gardens = null;

        if ($this->relationLoaded('gardens') && $this->gardens->count()) {
            $gardens .= $this->gardens->implode('name', ' & ');
        }
        return $gardens;
    }

    public function getUsageAttribute()
    {
        $usages = null;

        if ($this->relationLoaded('usages') && $this->usages->count()) {
            $usages .= $this->usages->implode('name', ' & ');
        }
        return $usages;
    }

    public function getValueAttribute()
    {
        $values = null;

        if ($this->relationLoaded('values') && $this->values->count()) {
            $values .= $this->values->implode('name', ' & ');
        }
        return $values;
    }

    public function getFlowerColorAttribute()
    {
        $flower_colors = null;

        if ($this->relationLoaded('flowerColors') && $this->flowerColors->count()) {
            $flower_colors .= $this->flowerColors->implode('name', ' & ');
        }
        return $flower_colors;
    }

    public function getFruitColorAttribute()
    {
        $fruit_colors = null;

        if ($this->relationLoaded('fruitColors') && $this->fruitColors->count()) {
            $fruit_colors .= $this->fruitColors->implode('name', ' & ');
        }
        return $fruit_colors;
    }

    public function getFoliageColorAttribute()
    {
        $foliage_colors = null;

        if ($this->relationLoaded('foliageColors') && $this->foliageColors->count()) {
            $foliage_colors .= $this->foliageColors->implode('name', ' & ');
        }
        return $foliage_colors;
    }

    public function getPlantConditionAttribute()
    {
        $conditions = null;

        if ($this->relationLoaded('plantingConditions') && $this->plantingConditions->count()) {
            $conditions .= $this->plantingConditions->implode('name', ' & ');
        }
        return $conditions;
    }

    public function getPropagationAttribute()
    {
        $propagations = null;

        if ($this->relationLoaded('propagations') && $this->propagations->count()) {
            $propagations .= $this->propagations->implode('name', ' & ');
        }
        return $propagations;
    }

    public function getOriginAttribute()
    {
        $origins = null;

        if ($this->relationLoaded('origins') && $this->origins->count()) {
            $origins .= $this->origins->implode('name', ' & ');
        }
        return $origins;
    }

    public function getHabitatAttribute()
    {
        $habitats = null;

        if ($this->relationLoaded('habitats') && $this->habitats->count()) {
            $habitats .= $this->habitats->implode('name', ' & ');
        }
        return $habitats;
    }

    public function getSeedFormationAttribute()
    {
        return !empty($this->attributes['seed_formation_id']) ? Arr::get(self::SEED_FORMATION, $this->attributes['seed_formation_id']) : null;
    }


    public function getGeographicalsAttribute()
    {
        $distributions = null;

        if ($this->relationLoaded('distributions') && $this->distributions->count()) {
            $distributions .= $this->distributions->implode('name', ' & ');
        }
        return $distributions;
    }

    public function getTransferAttribute()
    {
        if ($this->relationLoaded('operations') && count($this->operations)) {
            return $this->operations()
                ->where('operation_id', 3)
                ->latest()
                ->first();
        }
    }

    public function getPlantingAttribute()
    {
        if ($this->relationLoaded('operations') && count($this->operations)) {
            return $this->operations()
                ->where('operation_id', 2)
                ->latest()
                ->first();
        }
    }

    public function getSeedingAttribute()
    {
        if ($this->relationLoaded('operations') && count($this->operations)) {
            return $this->operations()
                ->where('operation_id', 1)
                ->latest()
                ->first();
        }
    }
}
