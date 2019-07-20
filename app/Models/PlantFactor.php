<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="PlantFactor",
 *      required={"name","type","parent_id"},
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
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
 *          type="integer",
 *          format="int32"
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
class PlantFactor extends BaseModel
{
    public static $rules=[
        'name' => 'required',
        'type' => 'required|string',
        'parent_id' => 'required|integer',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_factors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'parent_id', 'type', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json'
    ];

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class, 'plant_origin_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function plantApplications(): HasMany
    {
        return $this->hasMany(PlantApplication::class, ['plant_factor_application_id', 'plant_factor_growth_id', 'plant_factor_industry_id', 'plant_factor_part_id', 'plant_factor_usage_type_id'])->latest();
    }

}
