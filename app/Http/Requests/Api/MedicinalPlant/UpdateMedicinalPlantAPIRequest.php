<?php

namespace App\Http\Requests\Api\MedicinalPlant;

use App\Models\MedicinalPlant;
use InfyOm\Generator\Request\APIRequest;

class UpdateMedicinalPlantAPIRequest extends APIRequest
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
            'taxonomy_id' => 'required|exists:taxonomies,id',
            'ground_part_id' => 'nullable|exists:medicinal_parts,id',
            'general_origin_id' => 'nullable|exists:generals,id',

            //Medicinal Location
            'height' => 'nullable|string',
            'medicinal_properties' => 'nullable|string',
            'wooden_id' => 'nullable|exists:life_forms,id',
        ];
    }
}
