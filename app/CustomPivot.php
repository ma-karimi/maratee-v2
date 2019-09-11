<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class CustomPivot extends MorphPivot
{
    protected $casts = [
        'description' => 'json'
    ];
}
