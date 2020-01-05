<?php

namespace App\Http\Requests\Api;

use App\Models\Citation;
use App\Models\PaleontologyMedia;
use InfyOm\Generator\Request\APIRequest;

class UpdatePaleontologyCitationAPIRequest extends APIRequest
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
        return Citation::$rules;
    }
}
