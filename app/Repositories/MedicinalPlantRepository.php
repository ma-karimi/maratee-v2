<?php

namespace App\Repositories;

use App\Models\{MedicinalPlant};
use Illuminate\Support\Arr;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicinalPlant::class;
    }

    public function create($input)
    {
        $model = parent::create(Arr::only($input, $this->medicinalData()));
        $this->storeEffectiveMaterials($input, $model);
        $this->storeMedicinalProperties($input, $model);
        $this->storeAerialParts($input, $model);


        return $model;
    }

    /**
     * @return array
     */
    private function medicinalData(): array
    {
        return ['taxonomy_id', 'ground_part_id', 'general_origin_id', 'fruit_color', 'flower_color', 'foliage_color', 'height', 'cycle_id', 'wooden_id', 'herbaceous_id', 'general_habitat_id'];
    }

    private function storeEffectiveMaterials($input, $medicinal)
    {
        $materials = request()->filled('materials') ? explode(',', $input['materials']) : [];
        $this->createHub($medicinal->id, 'effectiveMaterials', $materials);
    }

    private function storeMedicinalProperties($input, $medicinal)
    {
        $properties = request()->filled('properties') ? explode(',', $input['properties']) : [];
        $this->createHub($medicinal->id, 'properties', $properties);
    }

    public function update($input, $id)
    {
        $model = parent::update(Arr::only($input, $this->medicinalData()), $id);
        $this->storeEffectiveMaterials($input, $model);
        $this->storeMedicinalProperties($input, $model);
        $this->storeAerialParts($input, $model);

        return $model;
    }

    public function storeMedicinalApplication($input, $id)
    {
        $model = parent::update([
            'traditional_iranian_medicine' => $input['traditional_iranian_medicine'] ?? null,
            'natural_drug' => $input['natural_drug'] ?? null,
            'inherbal_medicine_store' => $input['inherbal_medicine_store'] ?? null,
            'hygienic_cosmetic_industry_id' => $input['hygienic_cosmetic_industry_id'],
            'exporting' => $input['exporting'] ?? null,
            'importing' => $input['importing'] ?? null,
            'cultivated_area_id' => $input['cultivated_area_id'],
        ], $id);
        $this->storeFoodIndustries($input, $model);
        $this->storeOtherIndustries($input, $model);
        $this->storeInsdustrialPotential($input, $model);
        return $model;

    }

    private function storeFoodIndustries($input, $medicinal)
    {
        $industries = request()->filled('food_industries') ? explode(',', $input['food_industries']) : [];
        $this->createHub($medicinal->id, 'foodIndustries', $industries);
    }

    private function storeOtherIndustries($input, $medicinal)
    {
        $industries = request()->filled('other_industries') ? explode(',', $input['other_industries']) : [];
        $this->createHub($medicinal->id, 'otherIndustries', $industries);
    }

    private function storeInsdustrialPotential($input, $medicinal)
    {
        $industries = request()->filled('industrial_potentials') ? explode(',', $input['industrial_potentials']) : [];
        $this->createHub($medicinal->id, 'industrialPotentials', $industries);
    }

    public function storeProductOrMedicine(array $input, $id)
    {
        $model = $this->find($id);
        $this->storeProducts($input, $model);
        $this->storeMedicines($input, $model);

        return $model;
    }

    /**
     * @param array $input
     * @param $medicinal
     * @return mixed
     */
    private function storeProducts(array $input, $medicinal)
    {
        $products = request()->filled('products') ? explode(',', $input['products']) : [];
        $this->createHub($medicinal->id, 'products', $products);
    }

    /**
     * @param array $input
     * @param $medicinal
     * @return mixed
     */
    private function storeMedicines(array $input, $medicinal)
    {
        $medicines = request()->filled('medicines') ? explode(',', $input['medicines']) : [];
        $this->createHub($medicinal->id, 'medicines', $medicines);
    }

    private function storeProvinces($input, $medicinal)
    {
        $provinces = request()->filled('provinces') ? explode(',', $input['provinces']) : [];
        $this->createHub($medicinal->id, 'provinces', $provinces);
    }

    private function storeAerialParts($input, $medicinal)
    {
        $aerialTypes = request()->filled('aerialTypes') ? explode(',', $input['aerialTypes']) : [];
        $this->createHub($medicinal->id, 'aerialTypes', $aerialTypes);
    }

}
