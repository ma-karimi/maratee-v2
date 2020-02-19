<?php

namespace App\Models;


use App\Models\Contracts\BaseModel;

class ModelHasRole extends BaseModel
{
    protected $appends = ['name'];
    protected $with = ['role'];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getNameAttribute()
    {
        return $this->role->name;
    }
}
