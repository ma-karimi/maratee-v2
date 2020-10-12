<?php

namespace App\Http\Requests\Api;

use App\Models\Herbarium;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class HerbariumAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \Throwable
     */
    public function authorize()
    {
        $herbarium = Herbarium::where('herbarium_number', $this->request->get('herbarium_number'))
        ->where('organization_id', $this->request->get('organization_id'))
            ->when($this->route('herbarium'), function ($query) {
                return $query->where('id', '!=', $this->route('herbarium'));
            })
            ->exists();
        throw_if($herbarium, ValidationException::withMessages(['herbarium_number' => 'Herbarium Number Duplicated!']));
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
