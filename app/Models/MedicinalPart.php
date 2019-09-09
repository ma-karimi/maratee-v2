<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPartAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="MedicinalPart",
 *      required={"name","type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
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
class MedicinalPart extends BaseModel
{
    use MedicinalPartAccessor;

    public const TYPE = [1 => 'aerial', 2 => 'ground'];

    public static $linguistically = ['name' => true];
    public static $rules = [
        'type' => 'required|integer',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
    ];


    /**
     * @return HasMany
     */
    /* public function medicinalPlant(): HasMany
     {
         return $this->hasMany(MedicinalPlant::class,'');
     }*/
}
