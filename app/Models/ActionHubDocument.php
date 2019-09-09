<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="ActionHubDocument",
 *      required={"action_hub_id","src"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="action_hub_id",
 *          description="action_hub_id",
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
class ActionHubDocument extends BaseModel
{
    public static $rules = [
        'action_hub_id' => 'required|exists:action_hubs,id',
        'src' => 'required|string',
        'src_description' => 'string',
    ];


    /**
     * @return BelongsTo
     */
    public function actionHub(): BelongsTo
    {
        return $this->belongsTo(ActionHub::class);
    }
}
