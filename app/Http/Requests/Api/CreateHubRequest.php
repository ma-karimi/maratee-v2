<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use IlluminateAgnostic\Str\Support\Str;

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
        return $this->getHubModelRules() + [
                'ids.0' => 'required|integer',
                'class_id' => 'required|integer',
                'relation' => 'required|string',
            ];
    }

    public function messages()
    {
        return [
            'ids.0.required' => 'array ids is empty!'
        ];
    }

    private function getHubModelRules(): array
    {
        $source = explode('/', $this->url())[4];
        $source_model_class = resolve('App\\Models\\' . Str::studly(Str::singular($source)));
        $relation = $this->request->get('relation');
        $hub_table = $source_model_class->$relation()->getTable();

        if (!class_exists('App\\Models\\' . Str::studly(Str::singular($hub_table)))) {
            return [];
        }

        $hub_model = resolve('App\\Models\\' . Str::studly(Str::singular($hub_table)));

        return $hub_model::getRules();
    }
}
