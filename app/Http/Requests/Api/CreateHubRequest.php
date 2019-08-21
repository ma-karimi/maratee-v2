<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateHubRequest extends FormRequest
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
            'ids.0'=>'required|integer',
            'class_id'=>'required|integer',
            'relation'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'ids.0.required'=>'array ids is empty!'
        ];
    }
}
