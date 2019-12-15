<?php

namespace App\Models;

use App\Models\Accessor\MedicinalLocationAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalLocationRelations;

/**
 * @SWG\Definition(
 *      definition="MedicinalLocation",
 *      required={"medicinal_plant_id","location_id"}
 * )
 */
class MedicinalLocation extends BaseModel
{
    use MedicinalLocationRelations, MedicinalLocationAccessor;

    protected $with = ['determine', 'location', 'collect', 'constituents', 'treatment',  'distillation', 'secondaryMetabolites', 'effectiveMaterials'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'efficiency' => 'float',
    ];

}
