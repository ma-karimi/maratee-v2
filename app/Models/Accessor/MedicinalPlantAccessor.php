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
    public function getTraditionalIranianMedicineAttribute($value)
    {
        return Arr::get(self::TRADITIONAL_IRANIAN_MEDICINE, $value);
    }

    public function getNaturalDrugAttribute($value)
    {
        return Arr::get(self::NATURAL_DRUG, $value);
    }

    public function getInherbalMedicineStoreAttribute($value)
    {
        return Arr::get(self::INHERBAL_MEDICINE_STORE, $value);
    }

    public function getExportingAttribute($value)
    {
        return Arr::get(self::EXPORTING, $value);
    }

    public function getImportingAttribute($value)
    {
        return Arr::get(self::IMPORTING, $value);
    }

    public function getCultivatedAreaAttribute($value)
    {
        return Arr::get(self::CULTIVATED_AREA, $value);
    }

    public function getStudiedSampleAttribute($value)
    {
        return Arr::get(self::STUDIED_SAMPLE, $value);
    }

    public function getPresenceInCountryAttribute($value)
    {
        return Arr::get(self::PRESENCE_IN_COUNTRY, $value);
    }
}