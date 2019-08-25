<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;

class MedicinalPlantType extends BaseModel
{
    protected $guarded = [];
    protected $casts = ['name'=>'json', 'description'=>'json'];
}
