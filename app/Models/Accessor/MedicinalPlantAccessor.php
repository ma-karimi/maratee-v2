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
    public function getTraditionalIranianMedicineNameAttribute()
    {
        return Arr::get(self::TRADITIONAL_IRANIAN_MEDICINE, $this->traditional_iranian_medicine);
    }

    public function getNaturalDrugNameAttribute()
    {
        return Arr::get(self::NATURAL_DRUG, $this->natural_drug);
    }

    public function getInherbalMedicineStoreNameAttribute()
    {
        return Arr::get(self::INHERBAL_MEDICINE_STORE, $this->inherbal_medicine_store);
    }

    public function getExportingNameAttribute()
    {
        return Arr::get(self::EXPORTING, $this->exporting);
    }

    public function getImportingNameAttribute()
    {
        return Arr::get(self::IMPORTING, $this->importing);
    }




    public function getHygienicCosmeticAttribute()
    {
        return !empty($this->hygienic_cosmetic_industry_id) ? Arr::get(self::BOOLEAN, $this->hygienic_cosmetic_industry_id) : null;
    }

    public function getCultivatedAreaAttribute()
    {
        return !empty($this->cultivated_area_id) ? Arr::get(self::BOOLEAN, $this->cultivated_area_id) : null;
    }


    public function getDistributionsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('provinces') && $this->provinces->count()) {
            $authors = $this->provinces->implode('name_en', ' & ');
        }

        return $authors;
    }

    public function getCycleAttribute()
    {
        return !empty($this->cycle_id) ? Arr::get(self::CYCLE, $this->cycle_id) : null;
    }
    public function getWoodenAttribute()
    {
        return !empty($this->wooden_id) ? Arr::get(self::WOODEN, $this->wooden_id) : null;
    }
    public function getHerbaceousAttribute()
    {
        return !empty($this->herbaceous_id) ? Arr::get(self::HERBACEOUS, $this->herbaceous_id) : null;
    }


    public function getOtherProductsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('medicines') &&  $this->medicines->count()) {
            $item .= $this->medicines->implode('name_en', ' & ');
        }
        return $item;
    }
    public function getIndustriesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('otherIndustries') &&  $this->otherIndustries->count()) {
            $item .= $this->otherIndustries->implode('name', ' & ');
        }
        return $item;
    }
    public function getFoodsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('foodIndustries') &&  $this->foodIndustries->count()) {
            $item .= $this->foodIndustries->implode('name', ' & ');
        }
        return $item;
    }

    public function getPotentialsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('industrialPotentials') &&  $this->industrialPotentials->count()) {
            $item .= $this->industrialPotentials->implode('name', ' & ');
        }
        return $item;
    }

    public function getPharmaceuticalsAttribute()
    {
        $item = null;

        if ($this->relationLoaded('products') &&  $this->products->count()) {
            $item .= $this->products->implode('name_en', ' & ');
        }
        return $item;
    }
}
