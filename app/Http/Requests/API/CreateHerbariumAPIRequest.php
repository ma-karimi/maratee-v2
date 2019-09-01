<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use App\Models\Herbarium;
use App\Models\LifeForm;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class CreateHerbariumAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $array_id_types = [
            'general_ecology_id' => 'ecology',
            'general_habitat_id' => 'habitat',
            'general_origin_id' => 'origin',
            'general_type_id' => 'plant_type',
            'general_group_id' => 'group',
            'general_growth_id' => 'growth',
            'general_phenology_id' => 'phenology',
            'general_phytogeography_id' => 'phytogeography',
        ];
        $array_id_life_forms = [
            'cycle_id' => 'life_cycle',
            'wooden_id' => 'herbaceous_id',
            'leaf_id' => 'leaf',
            'herbaceous_id' => 'herbaceous',
        ];

        $this->validateGeneralIds($array_id_types);

        $this->validateLifeFormIds($array_id_life_forms);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Herbarium::$rules;
    }

    /**
     * @param array $array_id_types
     */
    private function validateGeneralIds(array $array_id_types): void
    {
        foreach ($array_id_types as $index => $value) {
            if (!empty($this->request->get($index))) {
                $record = General::ofIdType(request()->get($index), $value)->first();
                abort_if(!isset($record), JsonResponse::HTTP_BAD_REQUEST, "$index not exists");
            }
        }
    }

    /**
     * @param array $array_id_life_forms
     */
    private function validateLifeFormIds(array $array_id_life_forms): void
    {
        foreach ($array_id_life_forms as $index => $value) {
            if (!empty($this->request->get('life_forms')[$index])) {
                $record = LifeForm::ofIdType($this->request->get('life_forms')[$index], $value)->first();
                abort_if(!isset($record), JsonResponse::HTTP_BAD_REQUEST, "$index not exists");
            }
        }
    }

}
