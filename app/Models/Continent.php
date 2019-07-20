<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Continent",
 *            required={"name"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="parent_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Continent extends BaseModel
{


    public static $rules = [
        'parent_id' => 'integer|exists:continents,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'continents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'name', 'parent_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->latest();
    }


    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }


    /**
     * @return HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class)->latest();
    }

}
