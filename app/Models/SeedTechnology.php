<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedTechnology",
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="conserved_content",
 *          description="conserved_content",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="mean_seed_per_fruit",
 *          description="mean_seed_per_fruit",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="thousand_seed_weight",
 *          description="thousand_seed_weight",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="thousand_fruit_weight",
 *          description="thousand_fruit_weight",
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
 *          property="empty_impurity_seeds",
 *          description="empty_impurity_seeds",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="abnormal_seeding",
 *          description="abnormal_seeding",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rotten_seed",
 *          description="rotten_seed",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fresh_none_germinated",
 *          description="vigor",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="viability",
 *          description="viability",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_origin",
 *          description="seed_origin",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="received_date",
 *          description="examine",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="banked_date",
 *          description="examine",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="other_detail",
 *          description="other_detail",
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

    public static $linguistically = ['type' => false, 'other_detail' => false];
    public static $rules = [
        'conserved_content' => 'string',
        'mean_seed_per_fruit' => 'integer',
        'thousand_seed_weight' => 'integer',
        'thousand_fruit_weight' => 'integer',
        'humidity' => 'integer',
        'purity' => 'integer',
        'empty_impurity_seeds' => 'integer',
        'abnormal_seeding' => 'integer',
        'rotten_seed' => 'integer',
        'fresh_none_germinated' => 'integer',
        'seed_origin' => 'string',
        'viability' => 'integer',
        'receive_date' => 'date',
        'banked_date' => 'date',
        'visibility' => 'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_technologies';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'received_date', 'banked_date', 'deleted_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'json',
        'other_detail' => 'json'
    ];
}
