<?php

namespace App\Models;

use App\Models\Accessor\PlantAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ActionRelation,LocationRelation,ArticleRelation};
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"name","protection_id","general_phytogeography_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="is_flowering",
 *          description="is_flowering",
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
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="life_forms",
 *          description="life_forms",
 *          type="array",
 *     @SWG\Items(type="string")
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
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="subspecies_ids",
 *          description="subspecies_ids",
 *          type="array",
 *     @SWG\Items(type="integer")
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
class PlantHerbarium extends BaseModel
{
    use PlantScope, PlantAccessor, ActionRelation, ArticleRelation, LocationRelation;

    public const FLOWERING_TIME = [1=>'Farvardin', 2=>'Ordibehesht', 3=>'Khordad', 4=>'Tir', 5=>'Mordad', 6=>'Shahrivar', 7=>'Mehr', 8=>'Aban', 9=>'Azar', 10=>'Dey', 11=>'Bahman', 12=>'Esfand'];

    public static $linguistically = ['name' => true, 'description' => false, 'habitat_description' => false, 'ecology_description' => false];
    public static $rules = [
        'protection_id' => 'required|exists:protections,id',
        //taxonomy
        'family_id' => 'required|exists:generals,id',
        'genus_id' => 'exists:generals,id',
        'species_id' => 'exists:generals,id',
        'variety_id' => 'exists:generals,id',
        'order_id' => 'exists:generals,id',
        'class_id' => 'exists:generals,id',
        'subspecies_ids.*' => 'exists:generals,id',
        'is_flowering' => 'integer',
        //classification
        'general_ecology_id' => 'exists:generals,id',
        'general_habitat_id' => 'exists:generals,id',
        'general_origin_id' => 'exists:generals,id',
        'general_phytogeography_id' => 'required|exists:generals,id',
        'general_substrate_lichen_id' => 'exists:generals,id',
        'general_substrate_moss_id' => 'exists:generals,id',
        'general_substrate_diatom_id' => 'exists:generals,id',
    ];
    protected $appends = ['flowering_time_name'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_herbariums';
//    protected $with = ['generals'];
//    protected $appends = ['properties'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'life_forms' => 'json',
        'habitat_description' => 'json',
        'ecology_description' => 'json',
    ];

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
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Author::class, 'authorable',
            'author_hubs')
            ->whereNull('author_hubs.deleted_at')
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

    /**
     * @return HasMany
     */
    public function herbariums(): HasMany
    {
        return $this->hasMany(Herbarium::class);
    }

    public function generals(): BelongsToMany
    {
        return $this->belongsToMany(General::class,
            'plant_properties',
            'plant_id',
            'general_id')
            ->whereNull('plant_properties.deleted_at')
            ->withTimestamps();
    }

    public function taxonomy(): HasOne
    {
        return $this->hasOne(Taxonomy::class, 'plant_id');
    }

    public function scientific(): HasOneThrough
    {
        return $this->hasOneThrough(ScientificView::class, Taxonomy::class);
    }

    public function getPropertiesAttribute()
    {
        $properties = $this->has('generals') ? $this->generals->groupBy('type') : null;
        unset($this->generals);

        return $properties;
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

    public function leafLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_leaf_id');
    }

    public function woodenLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_wooden_id');
    }

    public function cycleLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_cycle_id');
    }

    public function herbaceousLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_herbaceous_id');
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


