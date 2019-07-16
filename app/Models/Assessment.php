<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            name="Assessment",
 *            required={"weight_k"},
 * 			@SWG\Property(name="date", type="string"),
 * 			@SWG\Property(name="seed_qt", type="integer"),
 * 			@SWG\Property(name="weight_k", type="integer"),
 * 			@SWG\Property(name="purity", type="integer"),
 * 			@SWG\Property(name="hollow", type="integer"),
 * 			@SWG\Property(name="repeat", type="integer"),
 * 			@SWG\Property(name="treatment", type="json"),
 * 			@SWG\Property(name="abnormality", type="integer"),
 * 			@SWG\Property(name="hard_seed", type="integer"),
 * 			@SWG\Property(name="vigor", type="integer"),
 * 			@SWG\Property(name="losses", type="integer"),
 * 			@SWG\Property(name="sprout", type="integer"),
 * 			@SWG\Property(name="sprout_rate", type="integer"),
 * 			@SWG\Property(name="sprout_index", type="integer"),
 * 			@SWG\Property(name="vigor_index", type="integer"),
 * 			@SWG\Property(name="root_length", type="integer"),
 * 			@SWG\Property(name="stem_length", type="integer"),
 * 			@SWG\Property(name="seedling_length", type="integer"),
 * 			@SWG\Property(name="root_stem_rate", type="integer"),
 * 			@SWG\Property(name="wet_unit_weight", type="integer"),
 * 			@SWG\Property(name="dry_unit_weight", type="integer"),
 * 			@SWG\Property(name="dry_material_rate", type="integer"),
 * 			@SWG\Property(name="seed_length", type="integer"),
 * 			@SWG\Property(name="seed_width", type="integer"),
 * 			@SWG\Property(name="description", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Assessment extends BaseModel
{

    public static $rules = ['weight_k' => 'required|integer'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assessments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['abnormality', 'created_at', 'date', 'deleted_at', 'description', 'dropped', 'dry_material_rate', 'dry_unit_weight', 'hard_seed', 'hollow', 'losses', 'purity', 'repeat', 'root_length', 'root_stem_rate', 'seed_length', 'seed_qt', 'seed_width', 'seedling_length', 'sprout', 'sprout_index', 'sprout_rate', 'stem_length', 'treatment', 'updated_at', 'vigor', 'vigor_index', 'weight_k', 'wet_uint_weight'];


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


    public function assessmentCollections()
    {
        return $this->hasMany(AssessmentCollection::class, 'assessment_id')->latest();
    }
}
