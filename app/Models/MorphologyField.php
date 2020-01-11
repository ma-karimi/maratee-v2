<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class MorphologyField extends BaseModel
{
    public static $rules = [
        'name' => 'required|string',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
