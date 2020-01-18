<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class GeneralAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws ValidationException
     */
    public function authorize()
    {
        if (General::where(['name' => $this->name])->exists()) {
            $duplicateErrorMessage = 'General Name & Type Repetitive!';

            throw ValidationException::withMessages(['name' => $duplicateErrorMessage, 'type' => $duplicateErrorMessage]);
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
        return General::$rules;
    }
}
