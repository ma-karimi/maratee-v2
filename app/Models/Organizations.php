<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Herbarium;
use App\Models\Product;

class Organizations extends BaseModel
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
        'name'=>'json',
        'description'=>'json',
    ];


    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class, 'organization_id')->latest();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function herbariums()
    {
        return $this->hasMany(Herbarium::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
