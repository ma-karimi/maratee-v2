<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Contracts\RelationshipsTrait;
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"name","taxonomy_id","classification_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="classification_id",
 *          description="classification_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="article_id",
 *          description="article_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
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
        'user_id' => 'exists:users,id',
        'article_id' => 'exists:articles,id',
        'location_id' => 'exists:locations,id',
        'taxonomies_id' => 'exists:taxonomies,id',
        'classification_id' => 'exists:classification,id',
        'exclusivity' => 'integer',
        //taxonomy
        'family_id' => 'required|exists:generals,id',
        'genus_id' => 'exists:generals,id',
        'species_id' => 'exists:generals,id',
        'variety_id' => 'exists:generals,id',
        'subspecies_id' => 'exists:generals,id',
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

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded=['id'];


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
        return $this->morphToMany(Article::class, 'articleable','article_hubs')->withTimestamps();
    }

    /**
     * @return MorphToMany
     */
    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable','location_hubs')->withTimestamps();
    }
    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable','user_hubs')->withTimestamps();
    }

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Author::class, 'authorable','author_hubs')->withTimestamps();
    }

    public function seeds(): BelongsToMany
    {
        return $this->belongsToMany(Seed::class,
            'seed_plants',
            'plant_id',
            'seed_id');
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class,'taxonomy_id');
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class,'classification_id');
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
}
