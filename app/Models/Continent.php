<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Continent",
 *            required={"name"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="string")
 *        )
 *
 */
class Continent extends BaseModel
{
    public static $rules = [
        'code' => 'string',
        'continent_id' => 'required|exists:continents,id',
    ];

    public $timestamps = false;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class)->latest();
    }

}
