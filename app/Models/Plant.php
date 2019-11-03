<?php

namespace App\Models;

use App\Models\Accessor\PlantAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ActionRelation, ArticleRelation};
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 *          property="cycle_id",
 *          description="id from life_forms ",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="wooden_id",
 *          description="id from life_forms ",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="herbaceous_id",
 *          description="id from life_forms ",
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
    use PlantScope, PlantAccessor, ActionRelation,HasMediaTrait,ArticleRelation;

    public const FLOWERING_TIME = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];


    protected $appends = ['flowering_time_name'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';



    public static $rules = [
        'protection_id' => 'required|exists:protections,id',
        'general_phytogeography_id' => 'required|exists:generals,id',
        //life_form
        'cycle_id' => 'exists:life_forms,id',
        'wooden_id' => 'exists:life_forms,id',
        'herbaceous_id' => 'exists:life_forms,id',
    ];

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
     * @return MorphToMany
     */
    public function transactions(): MorphToMany
    {
        return $this->morphToMany(Transaction::class, 'transactionable',
            'transactions')
            ->whereNull('transactions.deleted_at')
            ->withTimestamps();
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

    public function generals(): BelongsToMany
    {
        return $this->belongsToMany(General::class,
            'plant_properties',
            'plant_herbarium_id',
            'general_id')
            ->whereNull('plant_properties.deleted_at')
            ->withTimestamps();
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }


    public function getPropertiesAttribute()
    {
        $properties = $this->has('generals') ? $this->generals->groupBy('type') : null;
        unset($this->generals);

        return $properties;
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }

    public function generalEcology(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_ecology_id');
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

    public function cycle()
    {
        return $this->belongsTo(LifeForm::class,'cycle_id');
    }
    public function wooden()
    {
        return $this->belongsTo(LifeForm::class,'wooden_id');
    }
    public function herbaceous()
    {
        return $this->belongsTo(LifeForm::class,'herbaceous_id');
    }
    public function leaf()
    {
        return $this->belongsTo(LifeForm::class,'leaf_id');
    }

    public function generalLichen(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_substrate_lichen_id');
    }

    public function generalMoss(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_substrate_moss_id');
    }

    public function generalDiatom(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_substrate_diatom_id');
    }

}


