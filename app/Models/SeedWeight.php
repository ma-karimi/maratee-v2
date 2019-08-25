<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total_seed_weight",
 *          description="total_seed_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="total_fruit_weight",
 *          description="total_fruit_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="thousand_fruit_weight",
 *          description="thousand_fruit_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="thousand_seed_weight",
 *          description="thousand_seed_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="regenerated_fruit_weight",
 *          description="regenerated_fruit_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="regenerated_seed_weight",
 *          description="regenerated_seed_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="fruit_weight",
 *          description="fruit_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="seed_weight",
 *          description="seed_weight",
 *          type="float",
 *      ),
 *      @SWG\Property(
 *          property="collected_seeds_no",
 *          description="collected_seeds_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="fruit_mean_seeds_no",
 *          description="fruit_mean_seeds_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="other_detail",
 *          description="other_detail",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="regeneration_evaluation",
 *          description="regeneration_evaluation",
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

    public static $linguistically=['other_detail'=>false];
    public static $rules=[
        'total_seed_weight' => 'numeric',
        'total_fruit_weight' => 'numeric',
        'collected_seeds_no' => 'integer',
        'fruit_mean_seeds_no' => 'integer',
        'thousand_fruit_weight' => 'numeric',
        'thousand_seed_weight' => 'numeric',
        'regenerated_seed_weight' => 'numeric',
        'regenerated_fruit_weight' => 'numeric',
        'fruit_weight' => 'numeric',
        'seed_weight' => 'numeric',
        'regeneration_evaluation' => 'string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'other_detail' => 'json'
    ];

}
