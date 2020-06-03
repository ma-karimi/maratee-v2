<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class PaleobotanySample extends BaseModel
{
    public static $rules = [
        'paleobotany_taxonomy_id' => 'required|exists:paleobotany_taxonomies,id',
        'sample_id' => 'required|exists:paleobotany_taxonomies,id',
    ];
}
