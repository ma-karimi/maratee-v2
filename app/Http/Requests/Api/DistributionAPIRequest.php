<?php

namespace App\Http\Requests\Api;

use App\Models\Distribution;
use App\Models\Geographical;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class DistributionAPIRequest extends APIRequest
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
        return Distribution::$rules;
    }
}
