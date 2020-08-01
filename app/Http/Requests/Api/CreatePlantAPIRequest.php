<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use App\Models\LifeForm;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;


class CreatePlantAPIRequest extends APIRequest
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
            'protection_id' => 'nullable|exists:protections,id',
//            'organization_id' => 'required_if:is_flowering,0|exists:organizations,id',
//            'location_id' => 'required_if:is_flowering,0|exists:locations,id',
            //taxonomy
            'monopoly_of_iran_id' => 'nullable|numeric',
            'taxonomy_id' => 'required|exists:taxonomies,id|unique:plants',
            'life_form_id' => 'nullable|numeric',
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
