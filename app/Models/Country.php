<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Country extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'continent_id', 'created_at', 'deleted_at', 'name', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];


    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

}
