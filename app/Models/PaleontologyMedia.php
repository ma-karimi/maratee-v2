<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="PaleontologyMedia",
 *      required={"media_id","user_id"},
 *      @SWG\Property(
 *          property="credential_id",
 *          description="credential_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="media_id",
 *          description="media_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="exchange_id",
 *          description="exchange_id",
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
class PaleontologyMedia extends BaseModel
{

    public static $rules = [
        'credential_id' => 'exists:credentials,id',
        'media_id' => 'required|exists:medias,id',
        'user_id' => 'required|exists:users,id',
        'exchange_id' => 'exists:users,id',


    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_medias';

    /**
     * @return BelongsTo
     */
    public function credential(): BelongsTo
    {
        return $this->belongsTo(Credential::class,'credential_id');
    }

    /**
     * @return BelongsTo
     */
    public function exchange(): BelongsTo
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * @return BelongsTo
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
