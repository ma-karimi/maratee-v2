<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantTypeAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlantType",
 *      required={"name","type_id"}
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
        9 => 'treatment',
    ];
    public static $rules = [
        'type_id' => 'required|integer',
        'name' => 'required|string',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['type'];

    public function medicinals()
    {
        return $this->morphToMany(MedicinalPlant::class, 'hub','medicinal_hubs');
    }

}
