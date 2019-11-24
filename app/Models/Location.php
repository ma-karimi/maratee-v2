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
 *      required={"city_id", "province_id", 'address_en"},
 * )
 */
class Location extends BaseModel
{
    use SpatialTrait, LocationAccessor, LocationMutator ;

    public static $rules = [
        'city_id' => 'required|exists:cities,id',
        'village' => 'string',
        'min_altitude' => 'numeric',
        'max_altitude' => 'numeric',
        'address_en' => 'string',
        'address_fa' => 'string',
        'description' => 'string',
        'region_name' => 'string',
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


    protected $with = ['city.province.country', 'province.country'];

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
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }


    public function locationHubs()
    {
        return $this->morphedByMany(ActionHub::class, 'actionable');
    }

}
