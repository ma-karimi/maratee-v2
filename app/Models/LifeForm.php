<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
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
 *          description="type",
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

    public static $linguistically=['name'=>true];
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


    /**
     * @return HasMany
     */
    public function plantLifeForms(): HasMany
    {
        return $this->hasMany(PlantLifeForm::class)->latest();
    }
}
