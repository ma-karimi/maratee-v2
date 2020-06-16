<?php

namespace App\Http\Requests\Api\Botanical;


use App\Models\Botanical;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class BotanicalAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws ValidationException
     */
    public function authorize()
    {

        if (Botanical::where('taxonomy_id', $this->taxonomy_id)->where('collection_id', $this->collection_id)->exists() && $this->isMethod('post')) {
            $botanicalDuplicateErrorMessage = 'Taxonomy & Collection Repetitive!';
            throw ValidationException::withMessages(['collection_id' => 'Botanical Duplicated']);
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
        return Botanical::$rules;
    }
}
