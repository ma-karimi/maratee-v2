<?php

namespace App\Http\Requests\Api;

use App\Models\MedicinalPlantType;
use InfyOm\Generator\Request\APIRequest;

class UpdateMedicinalPlantTypeAPIRequest extends APIRequest
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
        return MedicinalPlantType::$rules;
    }
}
