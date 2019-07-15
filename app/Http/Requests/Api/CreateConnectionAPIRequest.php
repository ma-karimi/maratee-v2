<?php

namespace App\Http\Requests\Api;

use App\Models\Connection;
use InfyOm\Generator\Request\APIRequest;

class CreateConnectionAPIRequest extends APIRequest
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
            'location_id'=>'required|numeric',
            'department_id'=>'required|numeric',
            'user_id'=>'required|numeric',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'location_id.required'=>'وارد کردن لوکیشن الزامی است',
            'user_id.required'=>'وارد کردن کاربر الزامی است',
            'department_id.required'=>'وارد کردن دپارتمان الزامی است',
            'department_id.numeric'=>'فقط مقادیر عددی قابل قبول است',
            'location_id.numeric'=>'فقط مقادیر عددی قابل قبول است',
            'user_id.numeric'=>'فقط مقادیر عددی قابل قبول است',
        ];
    }
}
