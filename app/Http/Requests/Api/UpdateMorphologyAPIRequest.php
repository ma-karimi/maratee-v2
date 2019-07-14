<?php

namespace App\Http\Requests\Api;

use App\Models\Morphology;
use InfyOm\Generator\Request\APIRequest;

class UpdateMorphologyAPIRequest extends APIRequest
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
        return Morphology::$rules;
    }
}
