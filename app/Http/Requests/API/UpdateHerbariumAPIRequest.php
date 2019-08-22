<?php

namespace App\Http\Requests\Api;

use App\Models\Herbarium;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class UpdateHerbariumAPIRequest extends APIRequest
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
        foreach ($array_id_types as $index => $value) {
            if (request()->get($index) !== null) {
                $record = General::ofIdType($index,$value)->first();
                abort_if(!isset($record), JsonResponse::HTTP_BAD_REQUEST, "$index not exists");
            }
        }
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
}
