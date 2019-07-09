<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Villages extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'villages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'name', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];




    public function addresses()
    {
        return $this->hasMany(Address::class, 'village_id')->latest();
    }
}
