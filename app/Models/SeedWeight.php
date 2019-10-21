<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 *      required={"seed_id", "value", "type_id"},
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
 *      ),
 *      @SWG\Property(
 *          property="mean_seeds_per_fruit",
 *          description="mean_seeds_per_fruit",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="fruits_weight",
 *          description="fruits_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="seeds_weight",
 *          description="seeds_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="total_fruit_weight",
 *          description="total_fruit_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="total_seed_weight",
 *          description="total_seed_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="type_id",
 *          description="type_id",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="collected_seeds_no",
 *          description="collected_seeds_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="other_detail",
 *          description="other_detail",
 *          type="string",
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

    public const TYPES = [1 => 'Seed weight in Active Collection', 2 => 'Fruit weight in Active Collection', 3 => 'Seed weight in Base Collection', 4 => 'Fruit weight in Base Collection', 5 => 'Seed weight in Duplicate Collection', 6 => 'Fruit weight in Duplicate Collection', 7 => 'Regenerated seed weight in Active Collection', 8 => 'Regenerated fruit weight in Active Collection', 9 => 'Regenerated seed weight in Base Collection', 10 => 'Regenerated fruit weight in Base Collection', 11 => 'Regenerated seed weight in Duplicate Collection', 12 => 'Regenerated  fruit weight in Duplicate Collection'];
    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'mean_seeds_per_fruit' => 'numeric',
        'fruits_weight' => 'numeric',
        'seeds_weight' => 'numeric',
        'total_fruit_weight' => 'numeric',
        'total_seed_weight' => 'numeric',
        'value' => 'required|numeric',
        'type_id' => 'required|integer',
        'collected_seeds_no' => 'required|numeric'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';
    protected $casts = [
        'fruits_weight' => 'float',
        'seeds_weight' => 'float',
        'total_fruit_weight' => 'float',
        'total_seed_weight' => 'float',
        'value' => 'float',
    ];

    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }
}
