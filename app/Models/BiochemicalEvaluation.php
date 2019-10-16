<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="BiochemicalEvaluation",
 *            required={"organization_id"},
 * 			@SWG\Property(property="organization_id", type="integer"),
 * 			@SWG\Property(property="department_id", type="integer"),
 * 			@SWG\Property(property="project_id", type="integer"),
 * 			@SWG\Property(property="co_researcher_name", type="string"),
 * 			@SWG\Property(property="specimen_type_coll_id", type="integer"),
 * 			@SWG\Property(property="accession_code", type="string"),
 * 			@SWG\Property(property="regeneration_and_evaluation_code", type="string"),
 * 			@SWG\Property(property="treat", type="string"),
 * 			@SWG\Property(property="repeat", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BiochemicalEvaluation extends BaseModel
{
    protected $table = 'biochemical_evaluations';

    public static $rules = [
        'organization_id' => 'required|exists:organizations,id',
        'department_id' => 'exists:departments,id',
        'project_id' => 'exists:projects,id',
        'co_researcher_name' => 'string',
        'specimen_type_coll_id' => 'integer',
        'accession_code' => 'string',
        'regeneration_and_evaluation_code' => 'string',
        'treat' => 'string',
        'repeat' => 'string',
    ];

    public function vars(): HasMany
    {
        return $this->hasMany(BiochemicalEvaluationVar::class, 'biochemical_evaluation_id');
    }
}
