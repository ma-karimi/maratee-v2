<?php

namespace App\Http\Requests\Api\Botanical;


use InfyOm\Generator\Request\APIRequest;

class BotanicalGardenAPIRequest extends APIRequest
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
            'garden_id' => 'required_without:internal_habitat_id|exists:botanical_generals,id',
            'internal_habitat_id' => 'required_without:garden_id|exists:botanical_generals,id',
            'botanical_id' => 'required|exists:botanicals,id',
            'entrances' => 'nullable|array'
        ];
    }
}
