<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="Propagation",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="method",
 *          description="method",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
	 *     @SWG\Items(type="string")
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

class Propagation extends BaseModel
{
    public static $linguistically=['method'=>true,'description'=>true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'propagations';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'method' => 'json',
        'description' => 'json',
    ];


    public function botanicalPropagations()
    {
        return $this->hasMany(BotanicalPropagation::class)->latest();
    }
}
