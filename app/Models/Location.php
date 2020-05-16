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
    use SpatialTrait, LocationAccessor, LocationMutator;

    public $preventAttrSet = true;

    public static $rules = [
        'city_id' => 'nullable|exists:cities,id',
        'province_id' => 'required|exists:provinces,id',
        'village' => 'nullable|string',
        'min_altitude' => 'nullable|numeric',
        'max_altitude' => 'nullable|numeric',
        'address_en' => 'nullable|string',
        'address_fa' => 'nullable|string',
        'description' => 'nullable|string',
        'region_name' => 'nullable|string',
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


    protected $with = ['city', 'province', 'country'];

    protected $appends = ['address', 'longitudeSecond', 'longitudeMinute', 'longitudeDegree', 'latitudeSecond', 'latitudeMinute', 'latitudeDegree', 'longitude', 'latitude', 'cities', 'provinces'];

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
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
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

//
//    public function getCountryAttribute()
//    {
//        if ($this->relationLoaded('province') && !empty($this->province)) {
//            return $this->province->country;
//        }
//    }

    public function getProvincesAttribute()
    {
        if (!empty($this->country_id)) {
            return Province::where('country_id', $this->country_id)->get();
        }
        return [];
    }

    public function getCitiesAttribute()
    {
        if (!empty($this->province_id)) {
            return City::where('province_id', $this->province_id)->get();
        }
        return [];
    }
}
