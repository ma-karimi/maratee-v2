<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

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


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
