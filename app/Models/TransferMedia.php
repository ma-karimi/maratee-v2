<?php


namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="TransferMedia",
 *      required={"media_id", "transfer_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="media_id",
 *          description="media_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="transfer_id",
 *          description="transfer_id",
 *          type="integer",
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
class TransferMedia extends BaseModel
{

    public static $rules = [
        'media_id' => 'required|exists:medias,id',
        'transfer_id' => 'required|exists:transfers,id'
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['media_id', 'created_at', 'deleted_at', 'transfer_id', 'updated_at'];

}
