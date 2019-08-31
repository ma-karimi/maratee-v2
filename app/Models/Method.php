<?php

namespace App\Models;

use App\Models\Accessor\MethodAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Method",
 *      required={"name"},
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
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="type_id",
 *          description="type_id",
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
class Method extends BaseModel
{
    use MethodAccessor;
    public const TYPE = [1 => 'distillation', 2 => 'extraction', 3 => 'analyse'];
    public static $linguistically = ['name' => true, 'description' => false];
    public static $rules = [
        'type_id' => 'required|integer'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'methods';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];


    /**
     * @return HasMany
     */
    public function distillationMedicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class, 'method_distillation_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function extractionMedicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class, 'method_extraction_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function analyseMedicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class, 'method_analyse_id')->latest();
    }
}
