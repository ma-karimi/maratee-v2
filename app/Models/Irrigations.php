<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    protected $casts = ['type'=>'json', 'description'=>'json'];


    /**
     * @return HasMany
     */
    public function botanicalIrrigations(): HasMany
    {
        return $this->hasMany(BotanicalIrrigation::class)->latest();
    }
}
