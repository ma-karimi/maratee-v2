<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="evaluation",
 * 			@SWG\Property(property="date", type="string"),
 * 			@SWG\Property(property="exchange_seeds_no", type="integer"),
 * 			@SWG\Property(property="planted_seeds_no", type="integer"),
 * 			@SWG\Property(property="fresh_none_germinated_seeds", type="integer"),
 * 			@SWG\Property(property="rotten_seeds", type="integer"),
 * 			@SWG\Property(property="abnormal_seedling", type="integer"),
 * 			@SWG\Property(property="viability_percentage", type="integer"),
 * 			@SWG\Property(property="seedling_morality_no", type="integer"),
 * 			@SWG\Property(property="mean_fresh_seedling_weight", type="integer"),
 * 			@SWG\Property(property="mean_dry_seedling_weight", type="integer"),
 * 			@SWG\Property(property="dry_matter_percentage", type="integer"),
 * 			@SWG\Property(property="description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Evaluation extends BaseModel
{

    public static $linguistically = ['description' => false];
    public static $rules = [
        'date' => 'date',
        'exchange_seeds_no' => 'integer',
        'planted_seeds_no' => 'integer',
        'fresh_none_germinated_seeds' => 'integer',
        'rotten_seeds' => 'integer',
        'abnormal_seedling' => 'integer',
        'viability_percentage' => 'integer',
        'seedling_morality_no' => 'integer',
        'mean_fresh_seedling_weight' => 'integer',
        'mean_dry_seedling_weight' => 'integer',
        'dry_matter_percentage' => 'integer',
        'description' => 'array',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluations';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['description' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function dimensions()
    {
        return $this->belongsToMany(Dimension::class,
            'evaluation_dimensions',
            'evaluation_id',
            'dimension_id')->withPivot('value')->withTimestamps();
    }

}
