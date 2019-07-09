<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Soils extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soils';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'type', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];


    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalGardenAction::class, ['from_soil_id', 'to_soil_id'])->latest();
    }
}
