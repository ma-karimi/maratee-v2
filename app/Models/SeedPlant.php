<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="SeedPlant",
 *      required={"seed_id","plant_id"},
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          description="plant_id",
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
class SeedPlant extends BaseModel
{

    public static $linguistically = [''];

    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'plant_id' => 'required|exists:plants,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_plants';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function plant()
    {
        return $this->belongsTo(PlantHerbarium::class);
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }

}
