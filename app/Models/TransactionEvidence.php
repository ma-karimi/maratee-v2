<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @SWG\Definition(
 *      definition="TransactionEvidence",
 *      required={"transaction_id","src"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="transaction_id",
 *          description="transaction_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="src",
 *          description="src",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="src_description",
 *          description="src_description",
 *          type="string"
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
class TransactionEvidence extends BaseModel
{
    protected $table='transaction_evidences';
    public static $rules = [
        'transaction_id' => 'required|exists:transactions,id',
        'src' => 'required|string',
        'src_description' => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
