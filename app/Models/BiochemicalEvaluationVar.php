<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="BiochemicalEvaluationVar",
 *            required={"biochemical_evaluation_id","value"},
 * 			@SWG\Property(property="biochemical_evaluation_id", type="integer"),
 * 			@SWG\Property(property="var_id", type="integer"),
 * 			@SWG\Property(property="value", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BiochemicalEvaluationVar extends BaseModel
{
    protected $table = 'biochemical_evaluation_vars';

    public static $rules = [
        'biochemical_evaluation_id' => 'required|exists:biochemical_evaluations,id',
        'var_id' => 'integer',
        'value' => 'required|integer'
    ];

    public function biochemicalEvaluation(): BelongsTo
    {
        return $this->belongsTo(BiochemicalEvaluation::class, 'biochemical_evaluation_id');
    }
}
