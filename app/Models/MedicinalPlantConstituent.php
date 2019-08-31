<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlantConstituent",
 *      required={"medicinal_plant_id","constituent_id","value"},
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
 *          property="constituent_id",
 *          description="constituent_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="constituent_type_id",
 *          description="constituent_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="number",
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
class MedicinalPlantConstituent extends BaseModel
{
    public static $linguistically = ['value' => true];
    public static $rules = [
        'medicinal_plant_id' => 'required|exists:medicinal_plants,id',
        'constituent_id' => 'required|exists:constituents,id',
        'constituent_type_id' => 'required|exists:constituent_types,id',
        'value' => 'required|numeric'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plant_constituents';

    /**
     * @return BelongsTo
     */
    public function constituent(): BelongsTo
    {
        return $this->belongsTo(Constituent::class);
    }

    /**
     * @return BelongsTo
     */
    public function constituentType(): BelongsTo
    {
        return $this->belongsTo(ConstituentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

}
