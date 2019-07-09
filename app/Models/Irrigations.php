<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Irrigations extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'irrigations';

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



    public function botanicalIrrigations()
    {
        return $this->hasMany(BotanicalIrrigation::class, 'irrigation_id')->latest();
    }
}
