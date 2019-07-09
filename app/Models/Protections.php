<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Protections extends BaseModel
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
    protected $casts = [];



    public function cryoBanks()
    {
        return $this->hasMany(CryoBank::class, 'protection_id')->latest();
    }

}
