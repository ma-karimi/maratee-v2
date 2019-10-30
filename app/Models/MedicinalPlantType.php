<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantTypeAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlantType",
 *      required={"name","type_id"},
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
 *          type="integer"
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
class MedicinalPlantType extends BaseModel
{
    use MedicinalPlantTypeAccessor;
    public const TYPE = [
        1 => 'food_industry',
        2 => 'hygienic_cosmetic_industry',
        3 => 'industrial_potential',
        4 => 'other_industry',
        5 => 'secondary_metabolite',
        6 => 'material',
        7 => 'pharmaceutical',
        8 => 'stage_of_phenology',
    ];
    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string',
    ];

    protected $appends = ['type'];

    public function medicinalPlant()
    {
        return $this->belongsToMany(MedicinalPlant::class,
            'medicinal_plant_properties',
            'medicinal_plant_type_id',
            'medicinal_plant_id'
        )->whereNull('medicinal_plant_properties.deleted_at')
            ->withTimestamps();
    }
}
