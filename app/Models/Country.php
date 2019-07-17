<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="Country",
 *            required={"name"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="name", type="array"),
 * 			@SWG\Property(name="code", type="string"),
 * 			@SWG\Property(name="continent_id", type="integer"),
 * 			@SWG\Property(name="description", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Country extends BaseModel
{


    public static $rules = [
        'code' => 'string',
        'continent_id' => 'required|exists:continents,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'continent_id', 'created_at', 'deleted_at', 'name', 'updated_at'];


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
