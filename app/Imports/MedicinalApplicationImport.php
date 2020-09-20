<?php


namespace App\Imports;

use App\Models\General;
use App\Models\MedicinalApplication;
use App\Models\MedicinalPart;
use App\Models\MedicinalPlantType;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class MedicinalApplicationImport implements OnEachRow, WithHeadingRow
{
    use TaxonomyTrait;

    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['genus'])) {
            $row = $this->storeTaxonomy($row);
            $row = $this->storeOrigin($row);
            $row = $this->storeHasAerialPart($row);
            $row = $this->storeHasUndergroundPart($row);
            $row = $this->storeHygenic($row);
            $row = $this->storeCultivated($row);
            $row = $this->storeTraditional($row);
            $row = $this->storeInHerbal($row);
            $row = $this->storeExporting($row);
            $row = $this->storeImporting($row);
            $row = $this->storeHasExporting($row);
            $row = $this->storeNaturalDrug($row);
            $row = $this->storeHasImporting($row);
            $model = MedicinalApplication::create(Arr::only($row, $this->medicinalData()));

            $model->foodIndustries()->sync($this->storeFoodIndustries($row));
            $model->otherIndustries()->sync($this->storeOtherIndustries($row));
            $model->industrialPotentials()->sync($this->storePotential($row));
            $model->aerialTypes()->sync($this->storeAerialTypes($row));
            $model->undergroundParts()->sync($this->storeUndergroundTypes($row));
            $this->log('Medicinal:' . $model->id);
        }

    }

    private function storeOrigin($row)
    {
        if (!empty($row['Origin'])) {
            $row['general_origin_id'] = General::firstOrCreate(['name' => trim($row['Origin']), 'type' => 'origin'])->id;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasAerialPart($row)
    {
        if (!empty($row['Has Aerial Part']) && trim($row['Has Aerial Part']) == 'yes') {
            $row['has_aerial_part'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasUndergroundPart($row)
    {
        if (!empty($row['Has Underground Part']) && trim($row['Has Underground Part']) == 'yes') {
            $row['has_ground_part'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHygenic($row)
    {
        if (!empty($row['Hygenic-Cosmetic industries']) && trim($row['Hygenic-Cosmetic industries']) == 'yes') {
            $row['has_ground_part'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeCultivated($row)
    {
        if (!empty($row['The cultivated area in the country']) && trim($row['The cultivated area in the country']) == 'yes') {
            $row['cultivated_area_id'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeTraditional($row)
    {
        if (!empty($row['Plants Used in Traditional Iranian Medicine'])) {
            $row['traditional_iranian_medicine'] = array_search(trim($row['Plants Used in Traditional Iranian Medicine']), MedicinalApplication::TRADITIONAL_IRANIAN_MEDICINE);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeInHerbal($row)
    {
        if (!empty($row['Plants used inHerbal medicine store'])) {
            $row['inherbal_medicine_store'] = array_search(trim($row['Plants used inHerbal medicine store']), MedicinalApplication::INHERBAL_MEDICINE_STORE);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeExporting($row)
    {
        if (!empty($row['Exporting'])) {
            $row['exporting'] = array_search(trim($row['Exporting']), MedicinalApplication::EXPORTING);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeImporting($row)
    {
        if (!empty($row['Importing'])) {
            $row['importing'] = array_search(trim($row['Importing']), MedicinalApplication::IMPORTING);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasExporting($row)
    {
        if (!empty($row['Has Exporting']) && trim($row['Has Exporting']) == 'yes') {
            $row['has_exporting'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeNaturalDrug($row)
    {
        if (!empty($row['Official Natural Drugs'])) {
            $row['natural_drug'] = array_search(trim($row['Official Natural Drugs']), MedicinalApplication::NATURAL_DRUG);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasImporting($row)
    {
        if (!empty($row['Has Importing']) && trim($row['Has Importing']) == 'yes') {
            $row['has_importing'] = 1;
        }
        return $row;
    }

    /**
     * @return array
     */
    private function medicinalData(): array
    {
        return [
            'taxonomy_id',
            'properties_description',
            'compounds'
        ];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeFoodIndustries($row)
    {
        if (!empty($row['Food Industries'])) {
            $food_industries = explode(' & ', trim($row['Food Industries']));
            foreach ($food_industries as $index => $food_industry) {
                MedicinalPlantType::firstOrCreate(['name' => trim($food_industry), 'type_id' => 1]);
            }
            $food_industries = MedicinalPlantType::whereIn($food_industries)->where('type_id', 1)->pluck('id')->toArray();
        }
        return $food_industries ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeOtherIndustries($row)
    {
        if (!empty($row['Other Industries'])) {
            $other_industries = explode(' & ', trim($row['Other Industries']));
            foreach ($other_industries as $index => $other_industry) {
                MedicinalPlantType::firstOrCreate(['name' => trim($other_industry), 'type_id' => 4]);
            }
            $other_industries = MedicinalPlantType::whereIn($other_industries)->where('type_id', 4)->pluck('id')->toArray();
        }
        return $other_industries ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storePotential($row)
    {
        if (!empty($row['Industrial Potential'])) {
            $potentials = explode(' & ', trim($row['Industrial Potential']));
            foreach ($potentials as $index => $potential) {
                MedicinalPlantType::firstOrCreate(['name' => trim($potential), 'type_id' => 3]);
            }
            $row['potentials'] = MedicinalPlantType::whereIn($potentials)->where('type_id', 3)->pluck('id')->toArray();
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeAerialTypes($row)
    {
        if (!empty($row['Aerial Types'])) {
            $aerial_types = explode(' & ', trim($row['Aerial Types']));
            foreach ($aerial_types as $index => $aerial_type) {
                MedicinalPart::firstOrCreate(['name' => trim($aerial_type), 'type_id' => 1]);
            }
            $aerial_types = MedicinalPart::whereIn($aerial_types)->where('type_id', 1)->pluck('id')->toArray();
        }
        return $aerial_types ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeUndergroundTypes($row)
    {
        if (!empty($row['Underground Parts'])) {
            $underground_types = explode(' & ', trim($row['Underground Parts']));
            foreach ($underground_types as $index => $underground_type) {
                MedicinalPart::firstOrCreate(['name' => trim($underground_type), 'type_id' => 2]);
            }
            $underground_types = MedicinalPart::whereIn($underground_types)->where('type_id', 2)->pluck('id')->toArray();
        }
        return $underground_types ?? [];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
