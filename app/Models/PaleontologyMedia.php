<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function credential()
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paleontology()
    {
        return $this->belongsTo(Paleontology::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
