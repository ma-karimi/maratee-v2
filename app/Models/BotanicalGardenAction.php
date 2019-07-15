<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            name="BotanicalGardenAction",
 *            required={"botanical_id", "planting_action_id", "from_soil_id", "from_lighting_id", "from_garden_id"},
 * 			@SWG\Property(name="botanical_id", type="integer"),
 * 			@SWG\Property(name="planting_action_id", type="integer"),
 * 			@SWG\Property(name="date", type="string"),
 * 			@SWG\Property(name="from_soil_id", type="integer"),
 * 			@SWG\Property(name="to_soil_id", type="integer"),
 * 			@SWG\Property(name="from_lighting_id", type="integer"),
 * 			@SWG\Property(name="to_lighting_id", type="integer"),
 * 			@SWG\Property(name="from_garden_id", type="string"),
 * 			@SWG\Property(name="to_garden_id", type="string"),
 * 			@SWG\Property(name="initial_place_type", type="array"),
 * 			@SWG\Property(name="destination_place_type", type="array"),
 * 			@SWG\Property(name="initial_place_condition", type="array"),
 * 			@SWG\Property(name="destination_place_condition", type="array"),
 * 			@SWG\Property(name="treatment", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class BotanicalGardenAction extends BaseModel
{


    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'planting_action_id' => 'required|exists:planting_actions,id',
        'from_soil_id' => 'required|exists:soils,id',
        'from_lighting_id' => 'required|exists:lightings,id',
        'from_garden_id' => 'required|exists:gardens,id',
        'to_soil_id' => 'required|exists:soils,id',
        'to_lighting_id' => 'required|exists:lightings,id',
        'to_garden_id' => 'required|exists:gardens,id',
        'date' => 'date',
    ];

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


    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }

    public function fromGarden()
    {
        return $this->belongsTo(Garden::class, 'from_garden_id');
    }

    public function toGarden()
    {
        return $this->belongsTo(Garden::class, 'to_garden_id');
    }

    public function fromLighting()
    {
        return $this->belongsTo(Lighting::class, 'from_lighting_id');
    }

    public function toLightings()
    {
        return $this->belongsTo(Lighting::class, 'to_lighting_id');
    }

    public function fromSoil()
    {
        return $this->belongsTo(Soil::class, 'from_soil_id');
    }

    public function toSoil()
    {
        return $this->belongsTo(Soil::class, 'to_soil_id');
    }

    public function plantingAction()
    {
        return $this->belongsTo(PlantingAction::class);
    }
}
