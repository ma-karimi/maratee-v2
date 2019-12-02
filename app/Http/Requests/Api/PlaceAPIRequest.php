<?php

namespace App\Http\Requests\Api;

use InfyOm\Generator\Request\APIRequest;

class PlaceAPIRequest extends APIRequest
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
            'name_en' => 'required|string',
            'name_fa' => 'nullable|string',
        ];
    }
}
