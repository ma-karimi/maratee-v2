<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 *      required={"total","seed_technology_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_technology_id",
 *          description="soil_technology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total",
 *          description="total",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="base",
 *          description="base",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="support",
 *          description="support",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="base_revival",
 *          description="base_revival",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active_revival",
 *          description="active_revival",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="support_revival",
 *          description="support_revival",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="revival_code",
 *          description="revival_code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
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

class SeedWeight extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'active_revival', 'base', 'base_revival', 'created_at', 'deleted_at', 'description', 'revival_code', 'seed_technology_id', 'support', 'support_revival', 'total', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'json'
    ];


    public function seedTechnology()
    {
        return $this->belongsTo(SeedTechnology::class, 'seed_technology_id');
    }

}
