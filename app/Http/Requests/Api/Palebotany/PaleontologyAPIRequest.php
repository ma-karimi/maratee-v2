<?php

namespace App\Http\Requests\Api;

use App\Models\Article;
use InfyOm\Generator\Request\APIRequest;

class PaleontologyAPIRequest extends APIRequest
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

    public function rules()
    {

        return [
            'catalog_no' => 'required|integer',
            'specimen_no' => 'required|string',
            'field_no' => 'nullable|string',
            'barcode_no' => 'nullable|string',
            'location_in_collection' => 'nullable|string',
            'general_order_id' => 'nullable|exists:generals,id',
            'general_plant_type_id' => 'nullable|exists:generals,id',
            'taxonomy_id' => 'required|exists:taxonomies,id',
        ];
    }
}
