<?php

namespace App\Repositories;

use App\Models\{MedicinalHub, MedicinalPlant, MedicinalPlantType, Medicine, Product, Province};
use Illuminate\Container\Container as Application;
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
        $model = parent::create(Arr::only($input, $this->MedicinalData()));
        $this->storeProvinces($input, $model->id);
        $this->storeProducts($input, $model->id);
        $this->storeMedicines($input, $model->id);

        return $model;
    }

    /**
     * @return array
     */
    private function MedicinalData(): array
    {
        return ['taxonomy_id', 'aerial_part_id', 'ground_part_id', 'general_origin_id', 'code_no', 'hygienic_cosmetic_industry_id', 'fruit_color', 'flower_color', 'foliage_color', 'height', 'cycle_id', 'wooden_id', 'herbaceous_id', 'general_habitat_id'];
    }

    private function storeProvinces($input, $medicinal_id)
    {
        $provinces = request()->filled('provinces') ? $input['provinces'] : [];
        $this->createHub($medicinal_id, 'provinces', $provinces);
    }

    /**
     * @param array $input
     * @param $medicinal_id
     * @return mixed
     */
    private function storeProducts(array $input, $medicinal_id)
    {
        $products = request()->filled('products') ? $input['products'] : [];
        $this->createHub($medicinal_id, 'products', $products);
    }

    /**
     * @param array $input
     * @param $medicinal_id
     * @return mixed
     */
    private function storeMedicines(array $input, $medicinal_id)
    {
        $medicines = request()->filled('medicines') ? $input['medicines'] : [];
        $this->createHub($medicinal_id, 'medicines', $medicines);
    }

    public function update($input, $id)
    {
        $model = parent::update(Arr::only($input, $this->MedicinalData()), $id);
        $this->storeProvinces($input, $model->id);
        $this->storeProducts($input, $model->id);
        $this->storeMedicines($input, $model->id);
        return $model;
    }

    public function storeMedicinalApplication($input, $id)
    {
        $model = parent::update([
            'traditional_iranian_medicine' => $input['traditional_iranian_medicine'] ?? null,
            'natural_drug' => $input['natural_drug'] ?? null,
            'inherbal_medicine_store' => $input['inherbal_medicine_store'] ?? null,
            'exporting' => $input['exporting'] ?? null,
            'importing' => $input['importing'] ?? null,
            'cultivated_area_id' => $input['cultivated_area_id'] ?? null,
        ], $id);
        $this->storeFoodIndustries($input, $model);
        $this->storeOtherIndustries($input, $model);
        $this->storeInsdustrialPotential($input, $model);
        return $model;

    }

    private function storeFoodIndustries($input, $model)
    {
        $industries = request()->filled('food_industries') ? $input['food_industries'] : [];
        $this->createHub($model->id, 'foodIndustries', $industries);
    }

    private function storeOtherIndustries($input, $model)
    {
        $industries = request()->filled('other_industries') ? $input['other_industries'] : [];
        $this->createHub($model->id, 'otherIndustries', $industries);
    }

    private function storeInsdustrialPotential($input, $model)
    {
        $industries = request()->filled('industrial_potentials') ? $input['industrial_potentials'] : [];
        $this->createHub($model->id, 'industrialPotentials', $industries);
    }

}
