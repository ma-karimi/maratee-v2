<?php

namespace App\Http\Requests\Api\Botanical;


use App\Models\BotanicalSoil;
use InfyOm\Generator\Request\APIRequest;

class BotanicalSoilAPIRequest extends APIRequest
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
        return BotanicalSoil::$rules;
    }
}
