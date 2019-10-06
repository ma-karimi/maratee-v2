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
        if (!empty($village->name))
            $data['en'] = trim($village->name);
        if (!empty($village->othername))
            $data['fa'] = trim($village->othername);
        return $data ?? null;
    }

    public function getCityConvertAttribute()
    {
        $city = $this->city();
        if (!empty($city->name))
            $data['en'] = trim($city->name);
        if (!empty($city->othername))
            $data['fa'] = trim($city->othername);
        return $data ?? null;
    }

    public function getProvinceAttribute()
    {
        $province = $this->province();
        if (!empty($province->name))
            $data['en'] = trim($province->name);
        if (!empty($province->othername))
            $data['fa'] = trim($province->othername);
        return $data ?? null;
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
