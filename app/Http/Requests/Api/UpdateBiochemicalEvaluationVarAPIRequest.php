<?php

namespace App\Http\Requests\Api;

use App\Models\BiochemicalEvaluationVar;
use InfyOm\Generator\Request\APIRequest;

class UpdateBiochemicalEvaluationVarAPIRequest extends APIRequest
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
        $rules = BiochemicalEvaluationVar::$rules;
        $UNIQUE_RULES$
        return $rules;
    }
}
