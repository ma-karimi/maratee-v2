<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="evaluation",
 *            required={"weight_k"},
 * 			@SWG\Property(property="date", type="string"),
 * 			@SWG\Property(property="accession", type="string"),
 * 			@SWG\Property(property="regeneration_evaluation", type="string"),
 * 			@SWG\Property(property="seed_qt", type="integer"),
 * 			@SWG\Property(property="weight_k", type="integer"),
 * 			@SWG\Property(property="purity", type="integer"),
 * 			@SWG\Property(property="hollow", type="integer"),
 * 			@SWG\Property(property="repeat", type="integer"),
 * 			@SWG\Property(property="treatment", type="json"),
 * 			@SWG\Property(property="abnormality", type="integer"),
 * 			@SWG\Property(property="hard_seed", type="integer"),
 * 			@SWG\Property(property="vigor", type="integer"),
 * 			@SWG\Property(property="losses", type="integer"),
 * 			@SWG\Property(property="sprout", type="integer"),
 * 			@SWG\Property(property="sprout_rate", type="integer"),
 * 			@SWG\Property(property="sprout_index", type="integer"),
 * 			@SWG\Property(property="vigor_index", type="integer"),
 * 			@SWG\Property(property="root_length", type="integer"),
 * 			@SWG\Property(property="stem_length", type="integer"),
 * 			@SWG\Property(property="seedling_length", type="integer"),
 * 			@SWG\Property(property="root_stem_rate", type="integer"),
 * 			@SWG\Property(property="wet_unit_weight", type="integer"),
 * 			@SWG\Property(property="dry_unit_weight", type="integer"),
 * 			@SWG\Property(property="dry_material_rate", type="integer"),
 * 			@SWG\Property(property="seed_length", type="integer"),
 * 			@SWG\Property(property="seed_width", type="integer"),
 * 			@SWG\Property(property="description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Evaluation extends BaseModel
{

    public static $linguistically = ['treatment' => true, 'description' => false];
    public static $rules = ['weight_k' => 'required|integer'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['regeneration_evaluation','accession','abnormality', 'created_at', 'date', 'deleted_at', 'description', 'dropped', 'dry_material_rate', 'dry_unit_weight', 'hard_seed', 'hollow', 'losses', 'purity', 'repeat', 'root_length', 'root_stem_rate', 'seed_length', 'seed_qt', 'seed_width', 'seedling_length', 'sprout', 'sprout_index', 'sprout_rate', 'stem_length', 'treatment', 'updated_at', 'vigor', 'vigor_index', 'weight_k', 'wet_uint_weight'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['treatment' => 'json', 'description' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];


    public function evaluationCollections()
    {
        return $this->hasMany(evaluationCollection::class, 'evaluation_id')->latest();
    }
}
