<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="MedicinalPlantMorphology",
 *      required={"medicinal_plant_id","morphology_id","value"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="medicinal_plant_id",
 *          description="medicinal_plant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="morphology_id",
 *          description="morphology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="array"
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
class MedicinalPlantMorphology extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plant_morphologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'medicinal_plant_id', 'morphology_id', 'updated_at', 'value'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['value' => 'json'];


    /**
     * @return BelongsTo
     */
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

    /**
     * @return BelongsTo
     */
    public function morphology(): BelongsTo
    {
        return $this->belongsTo(Morphology::class);
    }
}
