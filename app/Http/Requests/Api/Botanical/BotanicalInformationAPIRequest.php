<?php

namespace App\Http\Requests\Api\Botanical;


use InfyOm\Generator\Request\APIRequest;

class BotanicalInformationAPIRequest extends APIRequest
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
        //ToDo
        return [
            'seed_germination_id' => 'required',
            'comments' => 'nullable|string',
            'sensitivity_conditions' => 'nullable|string',
            'flowering_period' => 'nullable|string',
        ];
    }
}
