<?php

namespace App\Http\Requests\Api\Paleontology;

use App\Models\Article;
use InfyOm\Generator\Request\APIRequest;

class PaleontologyLocalityAPIRequest extends APIRequest
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

    public function rules()
    {

        return [
            'formation' => 'required',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
            'village' => 'nullable|string',
            'address_en' => 'required|string',
            'address_fa' => 'nullable|string',
            'region_name' => 'nullable|string',
            'stratigraphy' => 'nullable|string',
            'lithology' => 'nullable|string',
            'locality_description' => 'nullable|string',
        ];
    }
}
