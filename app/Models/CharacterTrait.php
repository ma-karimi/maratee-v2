<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="CharacterTrait",
 *      required={"character_id","block_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="character_id",
 *          description="character_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="block_id",
 *          description="block_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="observation_no",
 *          description="observation_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="planting_date",
 *          description="planting_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="observation_date",
 *          description="observation_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="days_start_flowering",
 *          description="days_start_flowering",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="days_flowering",
 *          description="days_flowering",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="days_seed_ripening",
 *          description="days_seed_ripening",
 *          type="integer"
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
class CharacterTrait extends BaseModel
{
    public static $rules = [
        'character_id' => 'required|exists:characters,id',
        'block_id' => 'required|exists:blocks,id',
    ];

    /**
     * @return BelongsTo
     */
    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    /**
     * @return BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

}
