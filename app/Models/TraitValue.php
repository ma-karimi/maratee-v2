<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="TraitValue",
 *      required={"seed_feature_id","character_trait_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_feature_id",
 *          description="seed_feature_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="character_trait_id",
 *          description="character_trait_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="name",
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
class TraitValue extends BaseModel
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
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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
