<?php

namespace App\Http\Requests\Api\MedicinalPlant;

use App\Models\MedicinalPlant;
use InfyOm\Generator\Request\APIRequest;

class MedicinalPlantAPIRequest extends APIRequest
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
        return MedicinalPlant::$rules;
    }
}
