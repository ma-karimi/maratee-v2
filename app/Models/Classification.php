<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Classification",
 *      required={"flowering_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cotyledon_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sperm_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
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
class Classification extends BaseModel
{


    public static $rules = [
        'flowering_id' => 'required|exists:generals,id',
        'cotyledon_id' => 'exists:generals,id',
        'sperm_id' => 'exists:generals,id',
    ];

    protected $dates = ['deleted_at'];


    /**
     * @return BelongsTo
     */
    public function flowering(): BelongsTo
    {
        return $this->belongsTo(General::class, 'flowering_id');
    }

    /**
     * @return BelongsTo
     */
    public function cotyledon(): BelongsTo
    {
        return $this->belongsTo(General::class, 'cotyledon_id');
    }

    /**
     * @return BelongsTo
     */
    public function sperm(): BelongsTo
    {
        return $this->belongsTo(General::class, 'sperm_id');
    }
}
