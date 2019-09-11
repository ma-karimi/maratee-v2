<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Lighting",
 *      required={"type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
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
class Lighting extends BaseModel
{
    public static $linguistically = ['type' => true, 'description' => false];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lightings';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['type' => 'json', 'description' => 'json'];


    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalOperation::class, ['from_lighting_id', 'to_lighting_id'])->latest();
    }
}
