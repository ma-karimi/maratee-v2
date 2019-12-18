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
    public const STUDIED_SAMPLE = [0 => 'unknown', 1 => 'wild', 2 => 'cultivated'];
    public const PRESENCE_IN_COUNTRY = [0 => 'unknown', 1 => 'native', 2 => 'endemic'];
    protected $with = ['determine', 'location', 'collect', 'constituents', 'treatment',  'distillation', 'secondaryMetabolites', 'phenology', 'distillation', 'extraction', 'analyse', 'article'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'efficiency' => 'float',
    ];

    protected $appends = [
        'studied_sample_name',
        'presence_in_country_name',
        'metabolites',
    ];
}
