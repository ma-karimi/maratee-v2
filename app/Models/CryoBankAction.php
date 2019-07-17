<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            name="CryoBankAction",
 *            required={"cryo_bank_id", "action_id"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="cryo_bank_id", type="integer"),
 * 			@SWG\Property(name="action_id", type="integer"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class CryoBankAction extends BaseModel
{


    public static $rules = [
        'cryo_bank_id' => 'required|exists:cryo_banks,id',
        'action_id' => 'required|exists:actions,id',
    ];
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
