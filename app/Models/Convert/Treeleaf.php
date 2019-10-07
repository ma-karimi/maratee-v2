<?php

namespace App\Models\Convert;


class Treeleaf extends BaseModel
{
    protected $table = 'treeleaf';

    protected $with = ['fam','gen','var','subspe','spe','village', 'cityR', 'provinceR'];

    public function village()
    {
        return $this->belongsTo(ConvertCity::class, 'city')->where('type', 'v');
    }
    public function cityR()
    {
        return $this->belongsTo(ConvertCity::class, 'city')->where('type', 'c');
    }
    public function provinceR()
    {
        return $this->belongsTo(ConvertCity::class, 'city')->where('type', 'p');
    }

    public function fam()
    {
        return $this->belongsTo(Taxonomytree::class,'family');
    }

    public function gen()
    {
        return $this->belongsTo(Taxonomytree::class,'genus');
    }

    public function spe()
    {
        return $this->belongsTo(Taxonomytree::class,'species');
    }

    public function subspe()
    {
        return $this->belongsTo(Taxonomytree::class,'subspecies');
    }

    public function var()
    {
        return $this->belongsTo(Taxonomytree::class,'variety');
    }

    public function getOrganizationAttribute()
    {
        return Herbariumname::find($this->attributes['herbariumname'])->name ?? null;
    }

    public function getProtectionAttribute()
    {
        return 'DD';
    }

    public function collect()
    {
        return $this->belongsTo(Person::class, 'gatherer');
    }

    public function detect()
    {
        return $this->belongsTo(Person::class, 'detector');
    }
}
