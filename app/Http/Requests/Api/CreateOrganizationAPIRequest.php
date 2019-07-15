<?php

namespace App\Http\Requests\Api;

use App\Models\Organization;
use InfyOm\Generator\Request\APIRequest;

class CreateOrganizationAPIRequest extends APIRequest
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
        return [
            'name'=>'required|min:3',
            'is_herbarium'=>'required',
            'phone'=>'required',
        ];
    }

    public function messages()
    {
        return[
          'name.required'=>'این فیلد الزامی است',
          'is_herbarium.required'=>'این فیلد الزامی است',
          'phone.required'=>'این فیلد الزامی است',
          'name.min'=>'حداقل ۳ کاراکتر الزامی است',
        ];
    }
}
