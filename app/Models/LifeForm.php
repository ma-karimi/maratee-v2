<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="LifeForm",
 *      required={"name", "type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="select one of wooden,leaf, herbaceous, life_cycle",
 *          type="string",
 *     ),
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
class LifeForm extends BaseModel
{

    public static $linguistically = ['name' => true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'life_forms';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];



    public function Plant(): BelongsToMany
    {
        return $this->belongsToMany(Plant::class,
            'plant_life_forms',
            'life_form_id',
            'plant_id');
    }
}
