<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="SeedTechnology",
 *      required={"seed_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_type",
 *          description="seed_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="husk_average",
 *          description="husk_average",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="husk_weight",
 *          description="husk_weight",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="humidity",
 *          description="humidity",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="purity",
 *          description="purity",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hard_seed",
 *          description="hard_seed",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="abnormality",
 *          description="abnormality",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sprout",
 *          description="sprout",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="vigor",
 *          description="vigor",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="examine",
 *          description="examine",
 *          type="string",
 *          format="date"
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

class SeedTechnology extends BaseModel
{

    public static $rules=[
        'seed_id' => 'required|exists:seeds,id',
        'husk_average' => 'integer',
        'husk_weight' => 'integer',
        'seed_weight' => 'integer',
        'humidity' => 'integer',
        'purity' => 'integer',
        'hard_seed' => 'integer',
        'abnormality' => 'integer',
        'sprout' => 'integer',
        'vigor' => 'integer',
        'examine' => 'date',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_technologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['abnormality', 'created_at', 'deleted_at', 'description', 'examine', 'hard_seed', 'humidity', 'husk_average', 'husk_weight', 'purity', 'seed_id', 'seed_type', 'seed_weight', 'sprout', 'type', 'updated_at', 'vigor'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'seed_type' => 'json',
        'type' => 'json',
        'description' => 'json',
    ];

    public function technologyCollections()
    {
        return $this->hasMany(TechnologyCollection::class, 'seed_technology_id')->latest();
    }

    public function seedWeights()
    {
        return $this->hasMany(SeedWeight::class, 'seed_technology_id')->latest();
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }
}
