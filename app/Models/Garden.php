<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Garden",
 *            required={"region", "section"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="region", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="section", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="number", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Garden extends BaseModel
{

    public static $linguistically = ['section' => true, 'region' => true, 'number' => false];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gardens';


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
        return $this->hasMany(BotanicalOperation::class, ['from_garden_id', 'to_garden_id'])->latest();
    }
}
