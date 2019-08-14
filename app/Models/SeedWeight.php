<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 *      required={"total_seed_weight"},
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
 *          property="total_seed_weight",
 *          description="total_seed_weight",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total_fruit_weight",
 *          description="total_fruit_weight",
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
 *          property="total_fruit_weight_revival",
 *          description="total_fruit_weight_revival",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="regeneration_evaluation",
 *          description="regeneration_evaluation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fruit_mean_seeds_no",
 *          description="fruit_mean_seeds_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="thousand_fruit_weight",
 *          description="fruit_mean_seeds_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="thousand_seed_weight",
 *          description="fruit_mean_seeds_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="other_detail",
 *          description="other_detail",
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

class SeedWeight extends BaseModel
{

    public static $linguistically=['other_detail'=>false];
    public static $rules=[
        'seed_id' => 'exists:seeds,id',
        'total_seed_weight' => 'required|integer',
        'total_fruit_weight' => 'integer',
        'collected_seeds_no' => 'integer',
        'total_fruit_weight_revival' => 'integer',
        'fruit_mean_seeds_no' => 'string',
        'thousand_seed_weight' => 'string',
        '' => 'string',
        'regeneration_evaluation' => 'string',
    ];

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
    protected $guarded = ['id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'other_detail' => 'json'
    ];


    public function Seed()
    {
        return $this->belongsTo(Seed::class, 'seed_id');
    }

}
