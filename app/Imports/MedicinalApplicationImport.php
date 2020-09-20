<?php


namespace App\Imports;

use App\Models\General;
use App\Models\MedicinalApplication;
use App\Models\MedicinalHub;
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
            $foods = collect($this->storeFoodIndustries($row))->filter()->all();
            $industries = collect($this->storeOtherIndustries($row))->filter()->all();
            $potentials = collect($this->storePotential($row))->filter()->all();
            $aerials = collect($this->storeAerialTypes($row))->filter()->all();
            $undergrounds = collect($this->storeUndergroundTypes($row))->filter()->all();
            if (count($foods)) {
                foreach ($foods as $item) {
                    MedicinalHub::create([
                        'medicinal_plant_id' => $model->id,
                        'hub_type' => 'App\Models\MedicinalPlantType',
                        'hub_id' => $item,
                    ]);
                }
            }
            if (count($industries)) {
                foreach ($industries as $item) {
                    MedicinalHub::create([
                        'medicinal_plant_id' => $model->id,
                        'hub_type' => 'App\Models\MedicinalPlantType',
                        'hub_id' => $item,
                    ]);
                }
            }
            if (count($potentials)) {
                foreach ($potentials as $item) {
                    MedicinalHub::create([
                        'medicinal_plant_id' => $model->id,
                        'hub_type' => 'App\Models\MedicinalPlantType',
                        'hub_id' => $item,
                    ]);
                }
            }
            if (count($aerials)) {

                foreach ($aerials as $item) {
                    MedicinalHub::create([
                        'medicinal_plant_id' => $model->id,
                        'hub_type' => 'App\Models\MedicinalPart',
                        'hub_id' => $item,
                    ]);
                }
            }
            if (count($undergrounds)) {
                foreach ($undergrounds as $item) {
                    MedicinalHub::create([
                        'medicinal_plant_id' => $model->id,
                        'hub_type' => 'App\Models\MedicinalPart',
                        'hub_id' => $item,
                    ]);
                }
            }
            $this->log('Medicinal:' . $model->id);
        }

    }

    private function storeOrigin($row)
    {
        if (!empty($row['origin'])) {
            $row['general_origin_id'] = General::firstOrCreate(['name' => trim($row['origin']), 'type' => 'origin'])->id;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasAerialPart($row)
    {
        $row['has_aerial_part'] = 0;

        if (!empty($row['has_aerial_part']) && trim($row['has_aerial_part']) == 'yes') {
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
        $row['has_ground_part'] = 0;

        if (!empty($row['has_underground_part']) && trim($row['has_underground_part']) == 'yes') {
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
        if (!empty($row['hygenic_cosmetic_industries']) && trim($row['hygenic_cosmetic_industries']) == 'yes') {
            $row['hygienic_cosmetic_industry_id'] = 1;
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeCultivated($row)
    {
        if (!empty($row['the_cultivated_area_in_the_country']) && trim($row['the_cultivated_area_in_the_country']) == 'yes') {
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
        if (!empty($row['plants_used_in_traditional_iranian_medicine'])) {
            $row['traditional_iranian_medicine'] = array_search(trim($row['plants_used_in_traditional_iranian_medicine']), MedicinalApplication::TRADITIONAL_IRANIAN_MEDICINE);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeInHerbal($row)
    {
        if (!empty($row['plants_used_inherbal_medicine_store'])) {
            $row['inherbal_medicine_store'] = array_search(trim($row['plants_used_inherbal_medicine_store']), MedicinalApplication::INHERBAL_MEDICINE_STORE);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeExporting($row)
    {
        if (!empty($row['exporting'])) {
            $row['exporting'] = array_search(trim($row['exporting']), MedicinalApplication::EXPORTING);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeImporting($row)
    {
        if (!empty($row['importing'])) {
            $row['importing'] = array_search(trim($row['importing']), MedicinalApplication::IMPORTING);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasExporting($row)
    {
        $row['has_exporting'] = 0;

        if (!empty($row['has_exporting']) && trim($row['has_exporting']) == 'yes') {
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
        if (!empty($row['official_natural_drugs'])) {
            $row['natural_drug'] = array_search(trim($row['official_natural_drugs']), MedicinalApplication::NATURAL_DRUG);
        }
        return $row;
    }

    /**
     * @param $row
     * @return array
     */
    private function storeHasImporting($row)
    {
        $row['has_importing'] = 0;

        if (!empty($row['has_importing']) && trim($row['has_importing']) == 'yes') {
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
            'traditional_iranian_medicine',
            'natural_drug',
            'inherbal_medicine_store',
            'exporting',
            'importing',
            'cultivated_area_id',
            'hygienic_cosmetic_industry_id',
            'general_origin_id',
            'has_aerial_part',
            'has_ground_part',
            'has_importing',
            'has_exporting',
            'local_name'
        ];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeFoodIndustries($row)
    {
        if (!empty($row['food_industries'])) {
            $food_industries = explode(' & ', trim($row['food_industries']));
            foreach ($food_industries as $index => $food_industry) {
                MedicinalPlantType::firstOrCreate(['name' => trim($food_industry), 'type_id' => 1]);
            }
            $food_industries = MedicinalPlantType::whereIn('name', $food_industries)->where('type_id', 1)->pluck('id')->toArray();
        }
        return $food_industries ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeOtherIndustries($row)
    {
        if (!empty($row['other_industries'])) {
            $other_industries = explode(' & ', trim($row['other_industries']));

            foreach ($other_industries as $index => $other_industry) {
                MedicinalPlantType::firstOrCreate(['name' => trim($other_industry), 'type_id' => 4]);
            }
            $other_industries = MedicinalPlantType::whereIn('name', $other_industries)->where('type_id', 4)->pluck('id')->toArray();
        }
        return $other_industries ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storePotential($row)
    {
        if (!empty($row['industrial_potential'])) {
            $potentials = explode(' & ', trim($row['industrial_potential']));
            foreach ($potentials as $index => $potential) {
                MedicinalPlantType::firstOrCreate(['name' => trim($potential), 'type_id' => 3]);
            }
            $potentials = MedicinalPlantType::whereIn('name', $potentials)->where('type_id', 3)->pluck('id')->toArray();
        }
        return $potentials ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeAerialTypes($row)
    {
        if (!empty($row['aerial_types'])) {
            $aerial_types = explode(' & ', trim($row['aerial_types']));
            foreach ($aerial_types as $index => $aerial_type) {
                MedicinalPart::firstOrCreate(['name' => trim($aerial_type), 'type_id' => 1]);
            }
            $aerial_types = MedicinalPart::whereIn('name', $aerial_types)->where('type_id', 1)->pluck('id')->toArray();
        }
        return $aerial_types ?? [];
    }

    /**
     * @param $row
     * @return array
     */
    private function storeUndergroundTypes($row)
    {
        if (!empty($row['underground_parts'])) {
            $underground_types = explode(' & ', trim($row['underground_parts']));
            foreach ($underground_types as $index => $underground_type) {
                MedicinalPart::firstOrCreate(['name' => trim($underground_type), 'type_id' => 2]);
            }
            $underground_types = MedicinalPart::whereIn('name', $underground_types)->where('type_id', 2)->pluck('id')->toArray();
        }
        return $underground_types ?? [];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
