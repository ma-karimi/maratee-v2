<?php

namespace App\Http\Requests\Api\Botanical;


use App\Models\Botanical;
use InfyOm\Generator\Request\APIRequest;

class BotanicalLocationAPIRequest extends APIRequest
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
            'village'=>'nullable|string',
            'city_id'=>'required|exists:cities,id',
            'country_id'=>'required|exists:countries,id',
            'province_id'=>'required|exists:provinces,id',
            'address_en'=>'required|string',
        ];
    }
}
