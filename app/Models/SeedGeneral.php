<?php

namespace App\Models;

use App\Models\Accessor\SeedGeneralAccessor;
use App\Models\Convert\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedGeneral",
 *      required={"name","type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="1:specimen_type, 2:landform, 3:slope_aspect, 4:soil_depth, 5:soil_texture, 6:drainage, 7:salinity, 8:soil_lime, 9:soil_erosion, 10:pollination_type, 11:pollination_agent, 12:fruit_type, 13:seed_collected_from, 14:life_form, 15:growth_form, 16:plant_mother_health, 17:plant_consumption, 18:used_part, 19:collection_name",
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
class SeedGeneral extends BaseModel
{
    use SeedGeneralAccessor;
    protected $appends=['type_name'];
    public const TYPE = [0 => 'unknown', 1 => 'specimen_type', 2 => 'landform', 3 => 'slope_aspect', 4 => 'soil_depth', 5 => 'soil_texture', 6 => 'drainage', 7 => 'salinity', 8 => 'soil_lime', 9 => 'soil_erosion', 10 => 'pollination_type', 11 => 'pollination_agent', 12 => 'fruit_type', 13 => 'seed_collected_from', 14 => 'life_form', 15 => 'growth_form', 16 => 'plant_mother_health', 17 => 'plant_consumption', 18 => 'used_part', 19 => 'collection_name'];

    protected $table = 'seed_generals';

    public static $rules = [
        'name' => 'required|string',
        'type' => 'required|integer',
    ];

}
