<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Morphology",
 *      required={"name","unit"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="unit",
 *          description="unit",
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
class Morphology extends BaseModel
{

    public static $rules=[
        'name' => 'required',
        'unit' => 'required'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'morphologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'unit', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json', 'unit' => 'json'];


    /**
     * @return HasMany
     */
    public function medicinalPlantMorphologies(): HasMany
    {
        return $this->hasMany(MedicinalPlantMorphology::class)->latest();
    }

}
