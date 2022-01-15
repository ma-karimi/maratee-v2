<?php

namespace App\Http\Requests\Api\Seed;

use App\Models\SeedExchange;
use App\Models\SeedWeight;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class SeedExchangeAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \Throwable
     */
    public function authorize()
    {
        $seedWeight = SeedWeight::find($this->get('seed_weight_id'));
        $min = Str::contains($this->get('specimen_type_name'), 'seed') ? $seedWeight->total_seed_weight - $this->get('exchanged_weight') : $seedWeight->total_fruit_weight - $this->get('exchanged_weight');
        throw_if($min < 0, ValidationException::withMessages(['exchanged_weight is greater than original weight']));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return SeedExchange::$rules;
    }
}
