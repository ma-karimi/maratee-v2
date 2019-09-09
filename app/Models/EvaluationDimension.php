<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="EvaluationDimension",
 *            required={"evaluation_id","dimension_id"},
 * 			@SWG\Property(property="evaluation_id", type="integer"),
 * 			@SWG\Property(property="dimension_id", type="integer"),
 * 			@SWG\Property(property="value", type="integer")
 *        )
 **/
class EvaluationDimension extends BaseModel
{

    public static $rules = [
        'evaluation_id' => 'required|exists:evaluations,id',
        'dimension_id' => 'required|exists:dimensions,id',
        'value' => 'integer',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluation_dimensions';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * @return BelongsTo
     */
    public function dimension(): BelongsTo
    {
        return $this->belongsTo(Dimension::class);
    }
}
