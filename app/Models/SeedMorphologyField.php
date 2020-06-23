<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedMorphologyField extends BaseModel
{
    public static $rules = [
        'name' => 'required|string',
    ];
}
