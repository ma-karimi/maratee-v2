<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="MedicinalPlantMethod",
 *      required={"medicinal_plant_id","method_id"},
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
 *          property="method_id",
 *          description="method_id",
 *          type="integer",
 *          format="int32"
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
class MedicinalPlantMethod extends BaseModel
{
    public static $linguistically=['value'=>true];
    public static $rules=[
        'medicinal_plant_id' => 'required|exists:medicinal_plants,id',
        'method_id' => 'required|exists:methods,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plant_methods';

    /**
     * @return BelongsTo
     */
    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }

    /**
     * @return BelongsTo
     */
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

}
