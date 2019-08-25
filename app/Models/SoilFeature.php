<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SoilFeature",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="unit",
 *          description="unit",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
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

class SoilFeature extends BaseModel
{

    public static $linguistically=['name'=>true,'unit'=>false];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soil_features';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'unit' => 'json'
    ];


    public function soils()
    {
        return $this->belongsToMany(Soil::class,
            'soil_has_soil_features',
            'soil_feature_id',
            'soil_id');
    }

}
