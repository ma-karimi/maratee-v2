<?php

namespace App\Models;


use App\Models\Contracts\BaseModel;

class ModelHasRole extends BaseModel
{
    protected $appends = ['name'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getNameAttribute()
    {
        $item = $this->load('role');
        return $item->role->name;
    }
}
