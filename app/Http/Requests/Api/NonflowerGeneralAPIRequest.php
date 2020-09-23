<?php

namespace App\Http\Requests\Api;

use App\Models\NonflowerGeneral;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class NonflowerGeneralAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (NonflowerGeneral::where(['name' => $this->request->get('name'), 'type' => $this->request->get('type')])->exists()) {
            throw ValidationException::withMessages(['name' => 'Name Duplicated!']);
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return NonflowerGeneral::$rules;
    }
}
