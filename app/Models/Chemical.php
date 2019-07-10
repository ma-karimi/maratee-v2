<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SeedChemicals;

class Chemical extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chemicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];

    /**
     * @return HasMany
     */
    public function seedChemicals(): HasMany
    {
        return $this->hasMany(SeedChemicals::class);
    }
}
