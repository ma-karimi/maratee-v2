<?php

namespace App\Models;

use App\Models\Accessor\MethodAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Method",
 *      required={"name"}
 * )
 */
class Method extends BaseModel
{
    use MethodAccessor;
    public const TYPE = [1 => 'distillation', 2 => 'extraction', 3 => 'analyse'];
    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'methods';

    protected $appends = ['type'];
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
