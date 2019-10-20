<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $evaluation_id
 * @property boolean $var_id
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MorphologyQualitativeEvaluation $morphologyQualitativeEvaluation
 */
class MorphologyQualitativeEvaluationVar extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['evaluation_id', 'var_id', 'value', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function morphologyQualitativeEvaluation()
    {
        return $this->belongsTo('App\Models\MorphologyQualitativeEvaluation', 'evaluation_id');
    }
}
