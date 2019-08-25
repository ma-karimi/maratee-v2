<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Entry",
 *            required={"type"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="type", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Entry extends BaseModel
{

    public static $linguistically=['type'=>true,'description'=>false];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entries';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['type' => 'json', 'description' => 'json'];


    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

}
