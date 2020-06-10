<?php

namespace App\Http\Requests\Api;

use App\Models\CryobankGeneral;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class CryobankGeneralAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws ValidationException
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
        return CryobankGeneral::$rules;
    }
}
