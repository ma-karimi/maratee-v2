<?php

namespace App\Http\Requests\Api;

use App\Models\Nonflower;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class NonflowerAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $nonflower = Nonflower::where('herbarium_number', $this->request->get('herbarium_number'))
            ->when($this->route('nonflower'), function ($query) {
                return $query->where('id', '!=', $this->route('nonflower'));
            })
            ->exists();
        throw_if($nonflower, ValidationException::withMessages(['herbarium_number' => 'Nonflower Number Duplicated!']));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Nonflower::$rules;
    }
}
