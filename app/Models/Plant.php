<?php

namespace App\Models;

use App\Models\Accessor\PlantAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ActionRelation, ArticleRelation};
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"location_id","organization_id","protection_id","general_phytogeography_id"}
 * )
 */
class Plant extends BaseModel implements HasMedia, AuditableContract
{
    use PlantScope, PlantAccessor, ActionRelation, ArticleRelation, HasMediaTrait, Auditable, AuditTrait;

    public const LIFE_FORM = [1 => 'annual', 2 => 'perennial', 3 => 'tree', 4 => 'shrubs'];

    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    protected $with = ['audits'];
    protected $appends = ['monopoly_of_iran', 'plant_geographicals', 'life_form', 'last_audit'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable', 'user_hubs')
            ->whereNull('user_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return MorphToMany
     */
    public function actors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable',
            'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return MorphMany
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable')
            ->whereNull('deleted_at');
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable', 'location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function protection()
    {
        return $this->belongsTo(Protection::class);
    }


    public function generalHabitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    public function generalOrigin(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_origin_id');
    }

    public function generalPhytogeography(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_phytogeography_id');
    }


    public function generalSubstrate()
    {
        return $this->belongsTo(General::class, 'general_substrate_id');
    }

    //Todo
//    public function geographicals(): MorphToMany
//    {
//        return $this->morphToMany(Geographical::class, 'distributable', 'distribution_hubs')
//            ->whereNull('distribution_hubs.deleted_at')
//            ->withTimestamps();
//    }

    public function geographicals()
    {
        return $this->belongsToMany(Geographical::class, 'plant_geographicals')
            ->whereNull('plant_geographicals.deleted_at')
            ->withTimestamps();
    }
}


