<?php


namespace App\Models\Relations;


use App\Models\BotanicalGeneral;
use App\Models\BotanicalIrrigation;
use App\Models\BotanicalOperation;
use App\Models\General;
use App\Models\Geographical;
use App\Models\InternalHabitat;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Protection;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait BotanicalRelation
{
    public function operations()
    {
        return $this->hasMany(BotanicalOperation::class)->latest();
    }

    public function values()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 1)
            ->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function usages()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 2)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function propagations()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 3)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function plantingConditions()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 4)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function cycles()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 5)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function foliageColors()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 3)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }

    public function flowerColors()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 1)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }

    public function fruitColors()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 2)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }


    public function botanicalIrrigation()
    {
        return $this->hasOne(BotanicalIrrigation::class);
    }


    public function generalHabitat()
    {
        return $this->belongsTo(General::class)->whereType('habitat');
    }

    public function origin()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'origin_id')->where('botanical_generals.type_id', 7);
    }

    public function internalHabitat()
    {
        return $this->belongsTo(InternalHabitat::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->where('is_herbarium', 1);
    }

    public function protection()
    {
        return $this->belongsTo(Protection::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function distributions(): MorphToMany
    {
        return $this->morphToMany(Geographical::class, 'distributable', 'distribution_hubs')
            ->whereNull('distribution_hubs.deleted_at')
            ->withTimestamps();
    }


    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable', 'location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }
}
