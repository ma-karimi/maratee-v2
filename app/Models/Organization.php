<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Organization",
 *      required={"name_en","phone","city_id"},
 * )
 */
class Organization extends BaseModel
{
    public static $rules = [
        'domestic_code' => 'nullable|string',
        'international_code' => 'nullable|string',
        'is_herbarium' => 'nullable|integer',
        'phone' => 'required|string',
        'name_en' => 'required|string',
        'city_id' => 'nullable|exists:cities,id',
        'email' => 'nullable|email',
        'website' => 'nullable|string'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';


    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->latest();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
