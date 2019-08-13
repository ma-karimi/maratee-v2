<?php

namespace App\Http\Requests\Api;

use App\Models\ArticleHub;
use App\Models\Component;
use App\Models\MedicinalPlantMethod;
use InfyOm\Generator\Request\APIRequest;

class UpdateMedicinalPlantMethodAPIRequest extends APIRequest
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
        return MedicinalPlantMethod::$rules;
    }
}
