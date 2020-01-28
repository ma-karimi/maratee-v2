<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedMorphologyField extends BaseModel
{
    public static $rules = [
        'green_house_id' => 'required|exists:green_houses,id',
        'seed_morphology_id' => 'required|seed_morphologies,id',
    ];

    public function greenHouse()
    {
        return $this->belongsTo(GreenHouse::class);
    }

    public function seedMorphology()
    {
        return $this->belongsTo(SeedMorphology::class);
    }
}
