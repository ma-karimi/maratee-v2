<?php

namespace App\Models;

use App\Models\Accessor\PlantAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ActionRelation, ArticleRelation};
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"location_id","organization_id","protection_id","general_phytogeography_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="is_flowering",
 *          description="is_flowering",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="sheets_no",
 *          description="sheets_no",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="samples_no",
 *          description="samples_no",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="tip_qt",
 *          description="tip_qt",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="physical_tip_qt",
 *          description="physical_tip_qt",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_lichen_id",
 *          description="general_substrate_lichen_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_moss_id",
 *          description="general_substrate_moss_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_diatom_id",
 *          description="general_substrate_diatom_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_phytogeography_id",
 *          description="general_phytogeography_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_ecology_id",
 *          description="general_ecology_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_origin_id",
 *          description="general_origin_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_habitat_id",
 *          description="general_habitat_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="protection_id",
 *          description="protection_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="life_form_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="ecology_description",
 *          description="ecology_description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="habitat_description",
 *          description="habitat_description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="flowering_time",
 *          description="flowering_time",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Plant extends BaseModel implements HasMedia
{
    use PlantScope, PlantAccessor, ActionRelation, HasMediaTrait, ArticleRelation;

//    public const FLOWERING_TIME = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];
    public const LIFE_FORM = [1 => 'annual', 2 => 'perennial', 3 => 'tree', 4 => 'shrubs'];

    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    protected $appends = ['monopoly_of_iran', 'plant_geographicals', 'life_form'];
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

    public function seeds(): BelongsToMany
    {
        return $this->belongsToMany(Seed::class,
            'seed_plants',
            'plant_id',
            'seed_id')
            ->whereNull('seed_plants.deleted_at')
            ->withTimestamps();
    }


    /**
     * @return HasMany
     */
    public function seedPlants(): HasMany
    {
        return $this->hasMany(SeedPlant::class)->latest();
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
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


    public function geographicals()
    {
        return $this->belongsToMany(Geographical::class, 'plant_geographicals')
            ->whereNull('plant_geographicals.deleted_at')
            ->withTimestamps();
    }

    public function herbarium()
    {
            return $this->hasOne(Herbarium::class, 'plant_id');
    }

}


