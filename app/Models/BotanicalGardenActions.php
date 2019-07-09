<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class BotanicalGardenActions extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_garden_actions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'date', 'deleted_at', 'destination_place_condition', 'destination_place_type', 'from_garden_id', 'from_lighting_id', 'from_soil_id', 'initial_place_condition', 'initial_place_type', 'planting_action_id', 'to_garden_id', 'to_lighting_id', 'to_soil_id', 'treatment', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['initial_place_type' => 'json', 'destination_place_type' => 'json', 'initial_place_condition' => 'json', 'destination_place_condition' => 'json', 'treatment' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];


    public function herbarium()
    {
        return $this->belongsTo(Herbariums::class);
    }

    public function media()
    {
        return $this->belongsTo(Medias::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
