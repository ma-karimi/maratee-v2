<?php

namespace App\Http\Requests\Api;

use InfyOm\Generator\Request\APIRequest;

class MorphologyQuantityAPIRequest extends APIRequest
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
            'quantitatives' => 'required|array',
            'quantitatives.*.value' => 'required|string',
            'quantitatives.*.seed_general_id' => 'required|exists:seed_generals,id',
        ];
    }
}
