<?php


namespace App\Models\Relations;


use App\Models\BotanicalGeneral;
use App\Models\BotanicalIrrigation;
use App\Models\BotanicalOperation;
use App\Models\BotanicalSoil;
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

    public function soilTypes()
    {
        return $this->hasMany(BotanicalSoil::class)->latest();
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

    public function origins()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 7)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function habitats()
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 16)->whereNull('botanical_general_hubs.deleted_at')
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

    public function soil()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'soil_id')->where('botanical_generals.type_id', 13);
    }

    public function seedGermination()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'seed_germination_id')->where('botanical_generals.type_id', 15);
    }

    public function entranceToGarden()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'entrance_to_garden_id')->where('botanical_generals.type_id', 12);
    }

    public function wooden()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'wooden_id')->where('botanical_generals.type_id', 14);
    }

    public function summerTolerance()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'summer_tolerance_id')->where('botanical_generals.type_id', 11);
    }

    public function winterTolerance()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'winter_tolerance_id')->where('botanical_generals.type_id', 10);
    }

    public function growthRate()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'growth_rate_id')->where('botanical_generals.type_id', 8);
    }

    public function seedRate()
    {
        return $this->belongsTo(BotanicalGeneral::class, 'seed_rate_id')->where('botanical_generals.type_id', 9);
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
