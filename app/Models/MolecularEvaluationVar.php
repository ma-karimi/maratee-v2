<?php

namespace App\Models;

use App\Models\Convert\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MolecularEvaluationVar",
 *      required={"molecular_evaluation_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="molecular_evaluation_id",
 *          description="molecular_evaluation_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="var_id",
 *          description="var_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="integer"
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
class MolecularEvaluationVar extends BaseModel
{

    public static $rules = [
        'molecular_evaluation_id' => 'required|exists:molecular_evaluations,id',
        'var_id' => 'integer',
        'value' => 'integer'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function molecularEvaluation()
    {
        return $this->belongsTo('App\Models\MolecularEvaluation');
    }
}
