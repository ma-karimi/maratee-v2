<?php

namespace App\Http\Requests\Api;

use App\Models\NonflowerTaxonomy;
use App\Models\Taxonomy;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class NonflowerTaxonomyAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route('nonflower_taxonomy');

        $data = parent::except('_method');
        if (!$id) {
            throw_if(NonflowerTaxonomy::where($data)->exists(), ValidationException::withMessages(['family_id' => 'The nonflower taxonomy data has already been taken.']));
        } else {
            throw_if(NonflowerTaxonomy::where($data)->where('id', '!=', $id)->exists(), ValidationException::withMessages(['family_id' => 'The nonflower taxonomy data has already been taken.']));
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
        return NonflowerTaxonomy::$rules;
    }
}
