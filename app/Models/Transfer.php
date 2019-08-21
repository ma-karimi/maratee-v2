<?php


namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Mutator\TransferCredentialMutator;

/**
 * @SWG\Definition(
 *      definition="Transfer",
 *      required={"entitiable_id", "transferable_id", "entitiable_type", "transferable_type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="entitiable_id",
 *          description="entitiables as herbarium,paleontology",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="entitiable_type",
 *          description="herbarium,paleontology",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="transferable_id",
 *          description="transferables as visit, borrow, exchange",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="transferable_type",
 *          description="visit, borrow, exchange",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="credential_id",
 *          description="credential_id",
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
class Transfer extends BaseModel
{

    public static $rules = [
        'credential_id' => 'exists:credentials,id',
        'entitiable_id' => 'required|integer',
        'entitiable_type' => 'required|string',
        'transferable_id' => 'required|integer',
        'transferable_type' => 'required|string',
    ];

    use TransferCredentialMutator;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'credential_id', 'updated_at', 'entitiable_id', 'entitiable_type', 'transferable_id', 'transferable_type'];

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'transfer_medias');
    }

    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }

    public function entitable()
    {
        return $this->morphTo();
    }

    public function transferable()
    {
        return $this->morphTo();
    }
}
