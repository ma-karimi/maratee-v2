<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Protection extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'protections';

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
    protected $casts = [
        'name'=>'json',
        'description'=>'json',
    ];

    public function seeds()
    {
        return $this->hasMany(Seed::class, 'protection_id')->latest();
    }

    public function cryoBanks()
    {
        return $this->hasMany(CryoBank::class, 'protection_id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function herbariums()
    {
        return $this->hasMany('App\Models\Herbarium');
    }

}
