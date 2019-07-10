<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Plantology extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plantologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'type', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];

    public function herbariums()
    {
        return $this->hasMany('App\Models\Herbarium',
            [
                'phenology_id',
                'plant_type_id'
            ]
        );
    }


}
