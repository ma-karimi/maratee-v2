<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Reproductions extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reproductions';

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


    public function botanicalReproductions()
    {
        return $this->hasMany(BotanicalReproduction::class, 'reproduction_id')->latest();
    }
}
