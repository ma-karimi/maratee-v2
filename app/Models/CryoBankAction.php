<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryoBankAction extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_bank_actions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['action_id', 'created_at', 'cryo_bank_id', 'deleted_at', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function cryoBank(): BelongsTo
    {
        return $this->belongsTo(CryoBank::class);
    }

    /**
     * @return BelongsTo
     */
    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }

}
