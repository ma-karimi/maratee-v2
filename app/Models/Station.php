<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Station",
 *      required={"location_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string",
 *     @SWG\Items(type="string"),
 *          format="string"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string",
 *     @SWG\Items(type="string"),
 *          format="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string",
 *     @SWG\Items(type="string"),
 *          format="string"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
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
class Station extends BaseModel
{
    public static $rules = [
        'location_id' => 'required|exists:locations,id',
    ];

    public static $linguistically = ['name' => false, 'code' => false, 'type' => false];

    protected $casts = [
        'name' => 'json',
        'code' => 'json',
        'type' => 'json',
    ];

    /**
     * @return BelongsTo
     */

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return HasMany
     */
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

}
