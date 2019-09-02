<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="TransactionHub",
 *      required={"transaction_id","transactionable_id","transactionable_type"},
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
 *          property="transactionable_id",
 *          description="transactionable_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="transactionable_type",
 *          description="transactionable_type",
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
class TransactionHub extends BaseModel
{
    public static $rules = [
        'transaction_id' => 'required|exists:transactions,id',
        'transactionable_id' => 'required|integer',
        'transactionable_type' => 'required|string',
    ];


    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
