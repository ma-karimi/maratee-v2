<?php


namespace App\Models\Relations;


use App\Models\BotanicalGeneral;
use App\Models\BotanicalIrrigation;
use App\Models\BotanicalOperation;
use App\Models\BotanicalSoil;
use App\Models\Distribution;
use App\Models\Location;
use App\Models\Protection;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait BotanicalRelation
{

    public function operations(): HasMany
    {
        return $this->hasMany(BotanicalOperation::class)->latest();
    }

    public function soilTypes(): HasMany
    {
        return $this->hasMany(BotanicalSoil::class)->latest();
    }

    public function internalHabitats(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_gardens', 'botanical_id', 'internal_habitat_id')->latest()->where('botanical_generals.type_id', 20)
            ->whereNull('botanical_gardens.deleted_at')
            ->withTimestamps();
    }

    public function gardens(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_gardens', 'botanical_id', 'garden_id')->latest()->where('botanical_generals.type_id', 19)
            ->whereNull('botanical_gardens.deleted_at')
            ->withTimestamps();
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 1)
            ->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function usages(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 2)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function propagations(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 3)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function plantingConditions(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 4)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function cycles(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 5)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function origins(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 7)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function habitats(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_general_hubs')->latest()->where('botanical_generals.type_id', 16)->whereNull('botanical_general_hubs.deleted_at')
            ->withTimestamps();
    }

    public function foliageColors(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 3)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }

    public function flowerColors(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 1)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }

    public function fruitColors(): BelongsToMany
    {
        return $this->belongsToMany(BotanicalGeneral::class, 'botanical_colors')->latest()->where('botanical_generals.type_id', 6)->where('botanical_colors.type_id', 2)->whereNull('botanical_colors.deleted_at')
            ->withTimestamps();
    }


    public function botanicalIrrigation(): HasOne
    {
        return $this->hasOne(BotanicalIrrigation::class);
    }

    public function soil(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'soil_id')->where('botanical_generals.type_id', 13);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'collection_id')->where('botanical_generals.type_id', 18);
    }

    public function seedGermination(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'seed_germination_id')->where('botanical_generals.type_id', 15);
    }

    public function wooden(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'wooden_id')->where('botanical_generals.type_id', 14);
    }

    public function summerTolerance(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'summer_tolerance_id')->where('botanical_generals.type_id', 11);
    }

    public function winterTolerance(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'winter_tolerance_id')->where('botanical_generals.type_id', 10);
    }

    public function growthRate(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'growth_rate_id')->where('botanical_generals.type_id', 8);
    }

    public function seedRate(): BelongsTo
    {
        return $this->belongsTo(BotanicalGeneral::class, 'seed_rate_id')->where('botanical_generals.type_id', 9);
    }

    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

    public function distributions(): MorphToMany
    {
        return $this->morphToMany(Distribution::class, 'distributable', 'distribution_hubs', null, 'geographical_id')
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
