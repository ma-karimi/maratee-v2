<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Country",
 *            required={"name_en"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name_en", type="string"),
 * 			@SWG\Property(property="name_fa", type="string"),
 * 			@SWG\Property(property="continent_id", type="integer"),
 * 			@SWG\Property(property="description", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Country extends BaseModel
{

    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'string',
        'continent_id' => 'required|exists:continents,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * @return BelongsTo
     */
    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    /**
     * @return HasMany
     */
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class)->latest();
    }

}
