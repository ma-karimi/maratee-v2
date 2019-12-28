<?php


namespace App\Models\Relations;


use App\Models\Action;
use App\Models\BotanicalIrrigation;
use App\Models\BotanicalOperation;
use App\Models\BotanicalProperty;
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
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 1);
    }

    public function usages()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 2);
    }

    public function propagations()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 3);
    }

    public function plantingConditions()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 4);
    }
    public function cycles()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 5);
    }


    public function botanicalIrrigation()
    {
        return $this->hasOne(BotanicalIrrigation::class);
    }


    public function generalHabitat()
    {
        return $this->belongsTo(General::class)->whereType('habitat');
    }

    public function generalOrigin()
    {
        return $this->belongsTo(General::class)->whereType('origin');
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
