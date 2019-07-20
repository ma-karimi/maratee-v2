<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Soil",
 *      required={"value","soil_id","soil_feature_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
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

class Soil extends Model
{

    public static $rules=[
        'type' => 'required',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soils';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'type', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'json',
        'description' => 'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];


    public function soilFeatures()
    {
        return $this->belongsToMany(SoilFeature::class,
            'soil_has_soil_features',
            'soil_id',
            'soil_feature_id');
    }

    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalGardenAction::class, ['from_soil_id', 'to_soil_id'])->latest();

    }

    /**
     * @return HasMany
     */
    public function medicinalPlants()
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }
}
