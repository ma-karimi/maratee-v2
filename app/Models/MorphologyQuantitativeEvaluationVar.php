<?php

namespace App\Models;

use App\Models\Convert\BaseModel;

/**
 * @SWG\Definition(
 *            definition="MorphologyQuantitativeEvaluationVar",
 *            required={"evaluation_id","value"},
 * 			@SWG\Property(property="evaluation_id", type="integer"),
 * 			@SWG\Property(property="var_id", type="integer"),
 * 			@SWG\Property(property="value", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class MorphologyQuantitativeEvaluationVar extends BaseModel
{
    public static $rules = [
        'evaluation_id' => 'required|exists:morphology_quantitative_evaluations,id',
        'var_id' => 'integer',
        'value' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function morphologyQuantitativeEvaluation()
    {
        return $this->belongsTo('App\Models\MorphologyQuantitativeEvaluation', 'evaluation_id');
    }
}
