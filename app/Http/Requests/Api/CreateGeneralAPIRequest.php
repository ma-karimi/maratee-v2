<?php

namespace App\Http\Requests\Api;

use App\Models\General;
use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Request\APIRequest;

class CreateGeneralAPIRequest extends APIRequest
{
    private function validateParentId($type): bool
    {
        $childParents=[
            'genus'=>'family',
            'species'=>'genus',
            'subspecies'=>'species',
            'variety'=>'subspecies',
        ];
        foreach ($childParents as $index => $item) {
            return ($index===$type) and  in_array($this->input('parent_id'), General::ofType($item)->pluck('id')->toArray());
        }
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $condition=$this->validateParentId($this->input('type'));
        abort_if(!$condition,JsonResponse::HTTP_BAD_REQUEST, 'parent_id does not valid');
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
