<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use App\Models\LifeForm;
use App\Models\Plant;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Http\JsonResponse;


class CreatePlantAPIRequest extends APIRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        $array_id_life_forms = [
//            'cycle_id' => 'life_cycle',
//            'wooden_id' => 'wooden',
//            'leaf_id' => 'leaf',
//            'herbaceous_id' => 'herbaceous',
//        ];
//        $array_id_types = [
////            'general_ecology_id' => 'ecology',
//            'general_habitat_id' => 'habitat',
//            'general_origin_id' => 'origin',
//            'general_phenology_id' => 'phenology',
//            'general_phytogeography_id' => 'phytogeography',
//            'general_substrate_lichen_id' => 'lichen',
//            'general_substrate_moss_id' => 'moss',
//            'general_substrate_diatom_id' => 'diatom',
//        ];
//
//        $this->validateGeneralIds($array_id_types);
//        $this->validateLifeFormIds($array_id_life_forms);
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
            'protection_id' => 'required_if:is_flowering,1|exists:protections,id',
//            'organization_id' => 'required_if:is_flowering,0|exists:organizations,id',
//            'location_id' => 'required_if:is_flowering,0|exists:locations,id',
            //taxonomy
            'monopoly_of_iran_id' => 'numeric',
            'taxonomy_id' => 'required|exists:taxonomies,id',
            'life_form_id' => 'numeric',
//            'number'=>'required_if:is_flowering,1|numeric',
//            'is_flowering' => 'numeric',
//            //classification
//            'general_habitat_id' => 'exists:generals,id',
//            'general_origin_id' => 'exists:generals,id',
//            'general_phytogeography_id' => 'exists:generals,id',
//            'general_substrate_id' => 'exists:generals,id',

        ];
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
}
