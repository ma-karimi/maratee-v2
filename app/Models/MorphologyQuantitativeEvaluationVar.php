<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="MorphologyQuantitativeEvaluationVar",
 *            required={"evaluation_id","value"}
 */
class MorphologyQuantitativeEvaluationVar extends BaseModel
{
    public static $rules = [
        'evaluation_id' => 'required|exists:morphology_quantitative_evaluations,id',
        'var_id' => 'integer',
        'value' => 'required|integer'
    ];

    /**
     * @return BelongsTo
     */
    public function morphologyQuantitativeEvaluation()
    {
        return $this->belongsTo(MorphologyQuantitativeEvaluation::class, 'evaluation_id');
    }
}
