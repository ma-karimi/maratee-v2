<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Repeat",
 *      required={"germination_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="germination_id",
 *          description="germination_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="count_no",
 *          description="count_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="germination_number",
 *          description="germination_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
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
class Repeat extends BaseModel
{
    public static $rules = [
        'germination_id' => 'required|exists:germinations,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'repeats';

    /**
     * @return BelongsTo
     */
    public function germination()
    {
        return $this->belongsTo(Germination::class);
    }

}
