<?php

namespace App\Http\Requests\Api;

use App\Models\BotanicalGardenAction;
use InfyOm\Generator\Request\APIRequest;

class UpdateBotanicalGardenActionAPIRequest extends APIRequest
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
        return BotanicalGardenAction::$rules;
    }
}
