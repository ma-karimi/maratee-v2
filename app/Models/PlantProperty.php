<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="PlantProperty",
 *      required={"plant_id","general_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          description="plant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_id",
 *          description="general_id",
 *          type="integer",
 *          format="int32"
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
class PlantProperty extends BaseModel
{
    public static $rules=[
        'plant_id' => 'required|exists:plants,id',
        'general_id' => 'required|exists:generals,id',
    ];
}
