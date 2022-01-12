<?php

namespace App\Models;

use App\Models\Accessor\SeedGeneralAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedGeneral",
 *      required={"name","type_id"},
 * )
 */
class SeedGeneral extends BaseModel
{
    use SeedGeneralAccessor;

    public const TYPE = [1 => 'specimen type',
        2 => 'landform',
        3 => 'slope aspect',
        4 => 'soil depth',
        5 => 'soil texture',
        6 => 'drainage',
        7 => 'salinity',
        8 => 'soil lime',
        9 => 'soil erosion',
        10 => 'pollination type',
        11 => 'pollination agent',
        12 => 'fruit type',
        13 => 'seed collected from',
        14 => 'life form',
        15 => 'growth form',
        16 => 'plant mother health',
        17 => 'plant consumption',
        18 => 'used part',
        19 => 'specimen type/collection',
        20 => 'climate',
        21 => 'communities',
        22 => 'associated species',
        23 => 'dormancy breaking treatment',
        24 => 'refrigerator',
        25 => 'month',
        26 => 'quantity',
        27 => 'quality',
        28 => 'collection',
        29 => 'habitat'];
    public static $rules = [
        'name' => 'required|string',
        'type_id' => 'required|integer',
    ];
    protected $appends = ['type'];

    public function qualitatives()
    {
        return $this->morphedByMany(MorphologyQualitativeEvaluation::class, 'morphology', 'morphology_variables')->withTimestamps()->whereNull('morphology_variables.deleted_at');
    }

    public function quantitatives()
    {
        return $this->morphedByMany(MorphologyQuantitativeEvaluation::class, 'morphology', 'morphology_variables')->withTimestamps()->whereNull('morphology_variables.deleted_at');
    }
}
