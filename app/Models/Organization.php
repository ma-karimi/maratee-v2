<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'domestic_code', 'email', 'international_code', 'is_herbarium', 'name', 'phone', 'updated_at', 'website'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];


    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function herbariums(): HasMany
    {
        return $this->hasMany(Herbarium::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

}
