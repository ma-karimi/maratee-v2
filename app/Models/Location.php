<?php

namespace App\Models;

use App\Models\Accessor\LocationAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Mutator\LocationMutator;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Location",
 *      required={"address", "city_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="village_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="city_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="region_name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="altitude",
 *          description="altitude",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="point",
 *          description="point",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="gps_used",
 *          description="gps_used",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="gps_datum",
 *          description="gps_datum",
 *          type="string",
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
class Location extends BaseModel
{
    use SpatialTrait, LocationAccessor, LocationMutator;

    public static $linguistically = ['description' => false, 'region_name' => false, 'address' => true];
    public static $rules = [
        'city_id' => 'required|exists:cities,id',
        'village_id' => 'exists:villages,id',
        'altitude' => 'numeric'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * @var array
     */
    protected $spatialFields = [
        'point'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['description' => 'json', 'region_name' => 'json', 'address' => 'json'];


    /**
     * @return HasMany
     */
    public function actionHubs(): HasMany
    {
        return $this->hasMany(ActionHub::class)->latest();
    }

    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class,
            'articleable', 'article_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function herbariums(): HasMany
    {
        return $this->hasMany(Herbarium::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function bioMoleculars(): HasMany
    {
        return $this->hasMany(BioMolecular::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs(): HasMany
    {
        return $this->hasMany(SeedHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedMolecular(): HasMany
    {
        return $this->hasMany(seedMolecular::class)->latest();
    }

    /**
     * @return BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function locationHubs()
    {
        return $this->morphedByMany(ActionHub::class, 'actionable');
    }
}
