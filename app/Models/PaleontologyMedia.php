<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="PaleontologyMedia",
 *      required={"paleontology_id","media_id","user_id"},
 *      @SWG\Property(
 *          property="credential_gift_id",
 *          description="credential_gift_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="credential_expense_id",
 *          description="credential_expense_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="credential_purchase_id",
 *          description="credential_purchase_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="credential_correspondence_id",
 *          description="credential_correspondence_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
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
 *       @SWG\Property(
 *          property="credential_fair_id",
 *          description="credential_fair_id",
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


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_medias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'credential_correspondence_id', 'credential_expense_id', 'credential_fair_id', 'credential_gift_id', 'credential_purchase_id', 'deleted_at', 'exchange_id', 'media_id', 'paleontology_id', 'updated_at', 'user_id'];

    /**
     * @return BelongsTo
     */
    public function credential(): BelongsTo
    {
        return $this->belongsTo(Credential::class, [
            'credential_correspondence_id',
            'credential_expense_id',
            'credential_fair_id',
            'credential_gift_id',
            'credential_purchase_id',
        ]);
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
    public function paleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
