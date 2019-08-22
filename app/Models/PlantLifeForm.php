<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="PlantLifeForm",
 *      required={"name", "type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          description="plant_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="life_form_id",
 *          description="life_form_id",
 *          type="integer",
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
class PlantLifeForm extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_life_forms';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['type' => 'enum'];


    /**
     * @return BelongsTo
     */
    public function woodenLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class)->where('type', 'wooden');
    }

    /**
     * @return BelongsTo
     */
    public function herbaceousLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class)->where('type', 'herbaceous');
    }
}
