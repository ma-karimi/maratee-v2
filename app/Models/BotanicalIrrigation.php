<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class BotanicalIrrigation extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_irrigations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'daytime', 'deleted_at', 'irrigation_id', 'requirement', 'seasonal_feature', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['requirement'=>'json', 'daytime'=>'json', 'seasonal_feature'=>'json'];


    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }

    public function irrigation()
    {
        return $this->belongsTo(Irrigations::class);
    }

}
