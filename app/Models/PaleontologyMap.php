<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PaleontologyMap",
 *      required={"paleontology_id","map_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="map_id",
 *          description="map_id",
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
class PaleontologyMap extends BaseModel
{

    public $table = 'paleontology_maps';


    /**
     * Validation rules
     *
     * @var array
     */
    /* public static $rules = [
         'paleontology_id'=>'required|exists:paleontologies:id',
         'map_id'=>'required|exists:maps:id'
     ];*/


}
