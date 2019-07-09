<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Garden extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gardens';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'number', 'region', 'section', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['region' => 'json', 'section' => 'json', 'number' => 'json'];


    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalGardenAction::class, ['from_garden_id', 'to_garden_id'])->latest();
    }
}
