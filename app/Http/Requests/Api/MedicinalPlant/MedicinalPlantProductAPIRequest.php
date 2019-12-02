<?php

namespace App\Http\Requests\Api\MedicinalPlant;

use InfyOm\Generator\Request\APIRequest;

class MedicinalPlantProductAPIRequest extends APIRequest
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
            'product_id' => 'nullable|exists:products,id',
            'medicine_id' => 'nullable|exists:medicines,id',
        ];
    }
}
