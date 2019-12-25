<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class CreateGeneralAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->input('parent_id') !== null) {
            $condition = $this->validateParentId($this->input('type'));
            abort_if(!$condition, JsonResponse::HTTP_BAD_REQUEST, 'parent_id does not valid');
        }
        return true;
    }

    private function validateParentId($type): bool
    {
        $condition = false;

        $childParents = [
            'genus' => 'family',
            'species' => 'genus',
            'subspecies' => 'species',
            'variety' => ['subspecies', 'species'],
        ];
        foreach ($childParents as $index => $item) {
            if ($index === $type and is_array($item)) {
                foreach ($item as $parent) {
                    $condition |= in_array($this->input('parent_id'), General::ofType($parent)->pluck('id')->toArray());
                }
            } else if ($index === $type and !is_array($item)) {
                $condition = in_array($this->input('parent_id'), General::ofType($item)->pluck('id')->toArray());

            }
        }
        return $condition;

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
