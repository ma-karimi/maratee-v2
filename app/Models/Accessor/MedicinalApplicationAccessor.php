<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use Illuminate\Support\Arr;

trait MedicinalApplicationAccessor
{
    public function getTraditionalIranianMedicineNameAttribute()
    {
        return !empty($this->traditional_iranian_medicine) ? Arr::get(self::TRADITIONAL_IRANIAN_MEDICINE, $this->traditional_iranian_medicine) : null;
    }

    public function getNaturalDrugNameAttribute()
    {
        return !empty($this->natural_drug) ? Arr::get(self::NATURAL_DRUG, $this->natural_drug) : null;
    }

    public function getInherbalMedicineStoreNameAttribute()
    {
        return !empty($this->inherbal_medicine_store) ? Arr::get(self::INHERBAL_MEDICINE_STORE, $this->inherbal_medicine_store) : null;
    }

    public function getExportingNameAttribute()
    {
        return !empty($this->exporting) ? Arr::get(self::EXPORTING, $this->exporting) : null;
    }

    public function getImportingNameAttribute()
    {
        return !empty($this->importing) ? Arr::get(self::IMPORTING, $this->importing) : null;
    }


    public function getHygienicCosmeticAttribute()
    {
        return !empty($this->hygienic_cosmetic_industry_id) ? Arr::get(self::BOOLEAN, $this->hygienic_cosmetic_industry_id) : null;
    }

    public function getCultivatedAreaAttribute()
    {
        return !empty($this->cultivated_area_id) ? Arr::get(self::BOOLEAN, $this->cultivated_area_id) : null;
    }

    public function getIndustriesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('otherIndustries') && $this->otherIndustries->count()) {
            $item .= $this->otherIndustries->implode('name', ' & ');
        }
        return $item;
    }


    public function getFoodsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('foodIndustries') && $this->foodIndustries->count()) {
            $item .= $this->foodIndustries->implode('name', ' & ');
        }
        return $item;
    }

    public function getPotentialsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('industrialPotentials') && $this->industrialPotentials->count()) {
            $item .= $this->industrialPotentials->implode('name', ' & ');
        }
        return $item;
    }

    public function getAerialTypeAttribute()
    {
        $item = null;

        if ($this->relationLoaded('aerialTypes') && $this->aerialTypes->count()) {
            $item .= $this->aerialTypes->implode('name', ' & ');
        }
        return $item;
    }
    public function getUndergroundPartAttribute()
    {
        $item = null;

        if ($this->relationLoaded('undergroundParts') && $this->undergroundParts->count()) {
            $item .= $this->undergroundParts->implode('name', ' & ');
        }
        return $item;
    }

}
