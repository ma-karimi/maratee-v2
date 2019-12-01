<?php

namespace App\Http\Requests\Api\Paleontology;

use App\Models\Article;
use InfyOm\Generator\Request\APIRequest;

class PaleontologyInformationAPIRequest extends APIRequest
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
            'collecting_date' => 'nullable|date',
            'identify_date' => 'nullable|date',
            'field_notes' => 'nullable|string',
        ];
    }
}
