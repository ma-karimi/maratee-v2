<?php

namespace App\Models\Convert;


class ConvertCity extends BaseModel
{
    protected $table = 'city';

    public function child()
    {
        return $this->hasMany(self::class, 'parentid')->where('id', '>', '1');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parentid');
    }

}
