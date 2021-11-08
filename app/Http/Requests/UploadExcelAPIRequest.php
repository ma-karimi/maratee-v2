<?php

namespace App\Http\Requests;

use InfyOm\Generator\Request\APIRequest;

class UploadExcelAPIRequest extends APIRequest
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
            'file' => 'required|mimes:xlsx, csv, xls',
            'excelName' => 'required|string',
            'modelName' => 'required|string',
        ];
    }

}
