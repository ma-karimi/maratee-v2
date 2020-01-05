<?php

namespace App\Http\Requests\Api\Paleontology;

use InfyOm\Generator\Request\APIRequest;

class PaleontologyGeologyRemarkAPIRequest extends APIRequest
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

    public function rules()
    {

        return [
            'geology_age_era_id' => 'required|exists:geology_ages,id',
            'geology_age_epoch_id' => 'nullable|exists:geology_ages,id',
            'geology_age_period_id' => 'required|exists:geology_ages,id',
            'geology_age_stage_id' => 'nullable|exists:geology_ages,id',
        ];
    }
}
