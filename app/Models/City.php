<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class City extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'created_at', 'deleted_at', 'name', 'province_id', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name'=>'json'];



    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
