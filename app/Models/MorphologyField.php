<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MorphologyField extends Model
{
    public static $rules = [
        'name' => 'required|string',
    ];
}
