<?php

namespace App\Models;

use App\Models\Accessor\LocationAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Mutator\LocationMutator;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

/**
 * @SWG\Definition(
 *      definition="SeedLocation",
 * )
 */
class SeedLocation extends BaseModel
{
    use SpatialTrait, LocationAccessor, LocationMutator;

    public static $rules = [
        'city_name' => 'nullable|string',
        'province_id' => 'nullable|string',
        'village_name' => 'nullable|string',
        'country_name' => 'nullable|string',
        'min_altitude' => 'nullable|numeric',
        'max_altitude' => 'nullable|numeric',
        'description' => 'nullable|string',
        'region_name' => 'nullable|string',
    ];
    public $preventAttrSet = true;

    /**
     * @var array
     */
    protected $spatialFields = [
        'point'
    ];

    protected $appends = ['longitudeSecond', 'longitudeMinute', 'longitudeDegree', 'latitudeSecond', 'latitudeMinute', 'latitudeDegree', 'longitude', 'latitude'];
}
