<?php

namespace App\Http\Requests\Api;

use InfyOm\Generator\Request\APIRequest;

class UserAPIRequest extends APIRequest
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
        $array = [
            'national_id' => 'nullable|string',
            'mobile' => 'required|string',
            'phone' => 'nullable|string',
            'name' => 'required',
        ];

        if ($this->isMethod('post')) {
            $array['password'] = 'required|min:6';
            $array['email'] = 'required|unique:users|email';
        }

        return $array;
    }
}
