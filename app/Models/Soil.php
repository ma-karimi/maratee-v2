<?php

namespace App\Models;

use App\Models\Accessor\SoilAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Soil",
 *      required={"ph_type_id","features"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ph_type_id",
 *          description="1 => 'neutral', 2 => 'alkaline', 3 => 'acid', 4 => 'indifferent'",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="features",
 *          description="fill this firlds as percent : clay_feature , loam_feature , fine_sand_feature ,
 *          coarse_sand_feature , gravel_feature , shale_feature , salt_feature ,
 *          gypsum_feature , peat_feature , compost_feature , manure_feature , bone_powder_feature",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
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
class Soil extends BaseModel
{
    use SoilAccessor;
    public static $linguistically = ['description' => false];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soils';
    public const PH = [1 => 'neutral', 2 => 'alkaline', 3 => 'acid', 4 => 'indifferent'];
    public static $rules = [
        'ph_type_id' => 'required',
        'features' => 'required',
    ];
    protected $appends = ['ph_type'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'features' => 'json',
        'description' => 'json'
    ];

}
