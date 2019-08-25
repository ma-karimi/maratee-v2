<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="GeologyAge",
 *            required={"name", "type", "type"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="type", type="string"),
 * 			@SWG\Property(property="parent_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class GeologyAge extends BaseModel
{

    const PARENT_ID = 'parent_id';
    public static $linguistically=['name'=>true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geology_ages';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * @return HasMany
     */
    public function paleontologies()
    {
        return $this->hasMany(Paleontology::class)->latest();
    }


    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany(self::class, self::PARENT_ID)->latest();
    }


    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, self::PARENT_ID);
    }
}
