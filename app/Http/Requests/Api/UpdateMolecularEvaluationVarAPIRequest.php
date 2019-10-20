<?php

namespace App\Http\Requests\Api;

use App\Models\MolecularEvaluationVar;
use InfyOm\Generator\Request\APIRequest;

class UpdateMolecularEvaluationVarAPIRequest extends APIRequest
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
        $rules = MolecularEvaluationVar::$rules;
        $UNIQUE_RULES$
        return $rules;
    }
}
