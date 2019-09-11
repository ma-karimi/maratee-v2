<?php

namespace App\Models;

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
class Continent extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class)->latest();
    }

}
