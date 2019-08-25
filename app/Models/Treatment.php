<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Treatment",
 *      required={"name","paleontology_id"},
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
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="datetime",
 *          type="string",
 *          format="date-time"
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
class Treatment extends BaseModel
{
    public static $linguistically = ['name' => true, 'description' => false];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'treatments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'date'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json'
    ];

    public function soilFeatures()
    {
        return $this->belongsToMany(SoilFeature::class,
            'soil_has_soil_features',
            'soil_id',
            'soil_feature_id');
    }


    public function treatmentHubs()
    {
        return $this->morphedByMany(TreatmentHub::class, 'treatmentable');
    }
}
