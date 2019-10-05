<?php

namespace App\Models\Convert;


class Treeleaf extends BaseModel
{
    protected $table = 'treeleaf';

    protected $appends = [
        'village', 'cityConvert', 'province', 'country', 'organization', 'protection', 'collectors', 'detectors'
    ];

    public function hasVillage()
    {
        return !empty($this->city) && $this->village() instanceof ConvertCity;
    }

    public function village()
    {
        return $this->belongsTo(ConvertCity::class, 'city')->first();
    }

    public function city()
    {
        return $this->village()->parent();
    }

    public function province()
    {
        return $this->city()->parent();
    }

    public function getVillageAttribute()
    {
        $village = $this->village();
        return ['en' => trim($village->name), 'fa' => trim($village->othername)];
    }

    public function getCityConvertAttribute()
    {
        $city = $this->city();
        return ['en' => trim($city->name), 'fa' => trim($city->othername)];
    }

    public function getProvinceAttribute()
    {
        $province = $this->province();
        return ['en' => trim($province->name), 'fa' => trim($province->othername)];
    }

    public function getCountryAttribute()
    {
        return ['en' => 'Iran', 'fa' => 'ایران'];
    }

    public function getFamilyAttribute()
    {
        return Taxonomytree::find($this->attributes['family'])->name ?? null;
//        return $this->belongsTo(Taxonomytree::class,'family')->first()->name ?? null;
    }

    public function getGenusAttribute()
    {
        return Taxonomytree::find($this->attributes['genus'])->name ?? null;
//        return $this->belongsTo(Taxonomytree::class,'genus')->first()->name ?? null;
    }

    public function getSpeciesAttribute()
    {
        return Taxonomytree::find($this->attributes['species'])->name ?? null;
//        return $this->belongsTo(Taxonomytree::class,'species')->first()->name ?? null;
    }

    public function getSubspeciesAttribute()
    {
        return Taxonomytree::find($this->attributes['subspecies'])->name ?? null;
//        return $this->belongsTo(Taxonomytree::class,'subspecies')->first()->name ?? null;
    }

    public function getVarietyAttribute()
    {
        return Taxonomytree::find($this->attributes['variety'])->name ?? null;
//        return $this->belongsTo(Taxonomytree::class,'variety')->first()->name ?? null;
    }

    public function getOrganizationAttribute()
    {
        return Herbariumname::find($this->attributes['herbariumname'])->name ?? null;
    }

    public function getProtectionAttribute()
    {
        return 'DD';
    }

    public function getCollectorsAttribute()
    {
        if (empty($this->attributes['gatherer']))
            return [];
        $names = $this->belongsTo(Person::class, 'gatherer')->first()->name ?? null;
        return explode('&', $names);
    }

    public function getDetectorsAttribute()
    {
        if (empty($this->attributes['detector']))
            return [];
        $names = $this->belongsTo(Person::class, 'detector')->first()->name ?? null;
        return explode('&', $names);
    }
}
