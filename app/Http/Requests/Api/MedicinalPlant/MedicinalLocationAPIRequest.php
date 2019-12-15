<?php

namespace App\Http\Requests\Api\MedicinalPlant;

use InfyOm\Generator\Request\APIRequest;

class MedicinalLocationAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'traditional_iranian_medicine' => 'nullable|numeric',
            'natural_drug' => 'nullable|numeric',
            'food_industry_id' => 'nullable|exists:medicinal_plant_types,id',
            'other_industry_id' => 'nullable|exists:medicinal_plant_types,id',
            'industrial_potential_id' => 'nullable|exists:medicinal_plant_types,id',
            'phenology_id' => 'nullable|exists:medicinal_plant_types,id',
            'method_distillation_id' => 'nullable|exists:methods,id',
            'method_extraction_id' => 'nullable|exists:methods,id',
            'method_analyse_id' => 'nullable|exists:methods,id',
            'treatment_id' => 'nullable|exists:medicinal_plant_types,id',
            'inherbal_medicine_store' => 'nullable|numeric',
            'exporting' => 'nullable|numeric',
            'importing' => 'nullable|numeric',
            'cultivated_area' => 'nullable|numeric',
            'studied_sample' => 'nullable|numeric',
        ];
    }
}
