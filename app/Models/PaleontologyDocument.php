<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="PaleontologyDocument",
 *      required={"paleontology_id","src"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
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
class PaleontologyDocument extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'src'=>'required|string',
        'src_description'=>'string',
    ];


    /**
     * @return BelongsTo
     */
    public function paleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class);
    }
}
