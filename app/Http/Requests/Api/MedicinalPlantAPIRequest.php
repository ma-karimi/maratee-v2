<?php

namespace App\Http\Requests\Api;

use App\Models\Article;
use App\Models\LifeForm;
use App\Models\MedicinalPlant;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Request\APIRequest;

class MedicinalPlantAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $array_id_life_forms = [
            'cycle_id' => 'life_cycle',
            'wooden_id' => 'wooden',
            'leaf_id' => 'leaf',
            'herbaceous_id' => 'herbaceous',
        ];
        $this->validateLifeFormIds($array_id_life_forms);
        return true;
    }

    /**
     * @param array $array_id_life_forms
     */
    private function validateLifeFormIds(array $array_id_life_forms): void
    {
        foreach ($array_id_life_forms as $index => $value) {
            if (!empty($this->request->get('life_forms')[$index])) {
                if (!LifeForm::ofIdType($this->request->get('life_forms')[$index], $value)->exists()) {
                   throw ValidationException::withMessages([$index=>"$index not exists"]);
                }
            }
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return MedicinalPlant::$rules;
    }
}
