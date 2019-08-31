<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Contracts\RelationshipsTrait;
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering_id",
 *          description="flowering_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cotyledon_id",
 *          description="cotyledon_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sperm_id",
 *          description="sperm_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
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
 *          property="domestic_name",
 *          description="domestic_name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="subspecies_ids",
 *          description="subspecies_ids",
 *          type="array",
 *     @SWG\Items(type="integer")
 *      ),
 *      @SWG\Property(
 *          property="exclusivity",
 *          description="exclusivity",
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
class Plant extends BaseModel
{
    use PlantScope;

    public static $linguistically = ['name' => true, 'description' => false, 'domestic_name' => false];

    public static $rules = [
        'exclusivity' => 'integer',
        //taxonomy
        'family_id' => 'required|exists:generals,id',
        'genus_id' => 'exists:generals,id',
        'species_id' => 'exists:generals,id',
        'variety_id' => 'exists:generals,id',
        'order_id' => 'exists:generals,id',
        'class_id' => 'exists:generals,id',
        'subspecies_ids.*' => 'exists:generals,id',
        //classification
        'flowering_id' => 'required|exists:generals,id',
        'cotyledon_id' => 'exists:generals,id',
        'sperm_id' => 'exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';
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
        'domestic_name' => 'json',
    ];


    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class,
            'articleable', 'article_hubs')
            ->whereNull('article_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return MorphToMany
     */
    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class,
            'locationable', 'location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
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
     * @return BelongsTo
     */
    public function flowering(): BelongsTo
    {
        return $this->belongsTo(General::class, 'flowering_id');
    }

    /**
     * @return BelongsTo
     */
    public function cotyledon(): BelongsTo
    {
        return $this->belongsTo(General::class, 'cotyledon_id');
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
        return $this->hasOne(Taxonomy::class,'plant_id');
    }

    public function getPropertiesAttribute()
    {
        $properties = $this->has('generals') ? $this->generals->groupBy('type') : null;
        unset($this->generals);

        return $properties;
    }
}
