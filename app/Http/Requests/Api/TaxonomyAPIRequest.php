<?php

namespace App\Http\Requests\Api;

use App\Models\Taxonomy;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class TaxonomyAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \Throwable
     */
    public function authorize()
    {
        $id = $this->route('taxonomy');

        $data = parent::except('_method');
        if (!$id) {
            throw_if(Taxonomy::where($data)->exists(), ValidationException::withMessages(['family_id' => 'The taxonomy data has already been taken.']));
        } else {
            throw_if(Taxonomy::where($data)->where('id', '!=', $id)->exists(), ValidationException::withMessages(['family_id' => 'The taxonomy data has already been taken.']));
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
        return Taxonomy::$rules;
    }
}
