<?php

namespace App\Http\Requests\Api\Paleontology;

use InfyOm\Generator\Request\APIRequest;

class PaleontologyMapAPIRequest extends APIRequest
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
            'reference' => 'required|string',
            'scale' => 'nullable|string',
            'year' => 'nullable|numeric',
            'file' => 'required|image|mimes:jpeg,png'
        ];
    }
}
