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

    public function getCultivatedAreaNameAttribute()
    {
        return Arr::get(self::CULTIVATED_AREA, $this->cultivated_area);
    }

    public function getStudiedSampleNameAttribute()
    {
        return Arr::get(self::STUDIED_SAMPLE, $this->studied_sample);
    }

    public function getPresenceInCountryNameAttribute()
    {
        return Arr::get(self::PRESENCE_IN_COUNTRY, $this->presence_in_country);
    }
}
