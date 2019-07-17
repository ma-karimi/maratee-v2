<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="Garden",
 *            required={"region", "section"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="region", type="array"),
 * 			@SWG\Property(name="section", type="array"),
 * 			@SWG\Property(name="number", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Garden extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gardens';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'number', 'region', 'section', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['region' => 'json', 'section' => 'json', 'number' => 'json'];


    /**
     * @return HasMany
     */
    public function botanicalGardenActions(): HasMany
    {
        return $this->hasMany(BotanicalGardenAction::class, ['from_garden_id', 'to_garden_id'])->latest();
    }
}
