<?php

namespace App\Http\Requests\Api\MedicinalPlant;

use InfyOm\Generator\Request\APIRequest;

class MedicinalPlantCollectAPIRequest extends APIRequest
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
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
            'address_en' => 'required',
            'date'=>'required'
        ];
    }
}
