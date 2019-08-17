<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class CreateGeneralAPIRequest extends APIRequest
{
    private function validateParentId(string $type, array $parentArrayCollection): bool
    {
        return $this->request->get('type') === $type and in_array($this->request->get('parent_id'), $parentArrayCollection);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $family = General::ofType('family')->pluck('id')->toArray();
        $genus = General::ofType('genus')->pluck('id')->toArray();
        $species = General::ofType('species')->pluck('id')->toArray();

        if (($this->validateParentId('genus', $family) or
                $this->validateParentId('species', $genus) or
                $this->validateParentId('subspecies', $species)
        ) === false) {
            abort(JsonResponse::HTTP_BAD_REQUEST, 'parent_id does not valid');
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
        return General::$rules;
    }
}
