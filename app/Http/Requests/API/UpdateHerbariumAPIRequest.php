<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use App\Models\Herbarium;
use App\Models\LifeForm;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class UpdateHerbariumAPIRequest extends APIRequest
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
        return Herbarium::$rules;
    }
}
