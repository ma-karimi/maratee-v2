<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\City;
use App\Models\Village;
use App\Models\Location;

class Address extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'city_id', 'created_at', 'deleted_at', 'updated_at', 'village_id'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['address' => 'json'];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
