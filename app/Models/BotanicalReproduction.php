<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class BotanicalReproduction extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_reproductions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'deleted_at', 'reproduction_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }

    public function reproduction()
    {
        return $this->belongsTo(Reproduction::class);
    }

}
