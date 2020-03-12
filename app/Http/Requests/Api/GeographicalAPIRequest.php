<?php

namespace App\Http\Requests\Api;

use App\Models\Geographical;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class GeographicalAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws ValidationException
     */
    public function authorize()
    {

        if(Geographical::whereTypeId($this->type_id)->whereName(Str::lower($this->name))->exists()){
            throw ValidationException::withMessages(['name'=>'Distribution Name Duplicated!']);
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
        return Geographical::$rules;
    }
}
