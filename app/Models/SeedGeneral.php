<?php

namespace App\Models;

use App\Models\Accessor\SeedGeneralAccessor;
use App\Models\Convert\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedGeneral",
 *      required={"name","type_id"},
 * )
 */
class SeedGeneral extends BaseModel
{
    use SeedGeneralAccessor;
    public const TYPE = [1 => 'specimen type', 2 => 'landform', 3 => 'slope aspect', 4 => 'soil depth', 5 => 'soil texture', 6 => 'drainage', 7 => 'salinity', 8 => 'soil lime', 9 => 'soil erosion', 10 => 'pollination type', 11 => 'pollination agent', 12 => 'fruit type', 13 => 'seed collected from', 14 => 'life form', 15 => 'growth form', 16 => 'plant mother health', 17 => 'plant consumption', 18 => 'used part', 19 => 'collection name', 20 => 'climate', 21 => 'communities', 22 => 'associated species'];
    public static $rules = [
        'name' => 'required|string',
        'type_id' => 'required|integer',
    ];
    protected $appends = ['type'];
    protected $table = 'seed_generals';

}
