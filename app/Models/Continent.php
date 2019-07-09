<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Continent extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'continents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'name', 'parent_id', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }


    public function countries()
    {
        return $this->hasMany(Country::class, 'continent_id');
    }

}
