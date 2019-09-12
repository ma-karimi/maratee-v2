<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="Botanical",
 *            required={"plant_id"},
 * 			@SWG\Property(property="plant_id", type="integer"),
 * 			@SWG\Property(property="height", type="float"),
 * 			@SWG\Property(property="flower_color", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="fruit_color", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="foliage_color", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="seed_germination", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="growth_rate", type="integer"),
 * 			@SWG\Property(property="first_flowering", type="string"),
 * 			@SWG\Property(property="first_seeding", type="string"),
 * 			@SWG\Property(property="treatment", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="comments", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="garden_map", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="garden_name", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="planting", type="string"),
 * 			@SWG\Property(property="seed_rate", type="integer"),
 * 			@SWG\Property(property="seed_formation", type="integer"),
 * 			@SWG\Property(property="winter_tolerance", type="integer"),
 * 			@SWG\Property(property="summer_tolerance", type="integer"),
 * 			@SWG\Property(property="cutting_rooting", type="integer"),
 * 			@SWG\Property(property="general_habitat_id", type="integer"),
 * 			@SWG\Property(property="entrance_to_garden", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Botanical extends BaseModel
{
    public const GROWTH_RATES = [0 => 'unknown', 1 => 'very low', 2 => 'low', 3 => 'moderate', 4 => 'fast', 5 => 'very fast'];
    public const SEED_RATE = [0 => 'unknown', 1 => 'low', 2 => 'moderate', 3 => 'good', 4 => 'bumper'];
    public const SEED_FORMATION = [0 => 'unknown', 1 => 'yes', 2 => 'no'];
    public const WINTER_TOLERANCE = [0 => 'unknown', 1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving', 6 => 'minimum temperature'];
    public const SUMMER_TOLERANCE = [0 => 'unknown', 1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving'];

    public const ENTRANCE_TO_GARDEN = [0 => 'unknown', 1 => 'seedling', 2 => 'plant', 3 => 'bulb', 4 => 'bulbil', 5 => 'tuber', 6 => 'rhizome'];

    public static $linguistically = ['flower_color' => false, 'fruit_color' => false, 'foliage_color' => false, 'seed_germination' => false,'treatment' => false,'comments' => false, 'garden_map' => false, 'garden_name' => false, ];
    public static $rules = [
        'year' => 'date',
        'planting' => 'date',
        'cutting_rooting' => 'integer',
    ];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanicals';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'height' => 'float',
        'flower_color' => 'json',
        'fruit_color' => 'json',
        'foliage_color' => 'json',
        'seed_germination' => 'json',
        'treatment' => 'json',
        'comments' => 'json',
        'garden_map' => 'json',
        'garden_name' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'planting', 'updated_at', 'first_seeding', 'first_flowering'];


    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalOperation::class)->latest();
    }

    public function botanicalIrrigations($season = null)
    {
        return $this->hasMany(BotanicalIrrigation::class)
            ->when($season, function ($query, $season) {
                return $query->ofSeason($season);
            })->latest();
    }

    public function irrigation()
    {
        return $this->belongsToMany(
            Irrigation::class,
            'botanical_irrigations',
            'botanical_id',
            'irrigation_id')
            ->whereNull('botanical_irrigations.deleted_at')
            ->withPivot('requirement', 'daytime', 'seasonal_feature');
    }

    public function botanicalPropagations()
    {
        return $this->hasMany(BotanicalPropagation::class);
    }

    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function planting_actions()
    {
        return $this->belongsToMany(
            PlantingAction::class,
            'botanical_garden_actions',
            'botanical_id',
            'planting_action_id'
        )->whereNull('botanical_garden_actions.deleted_at')
            ->withTimestamps();
    }

    public function soil()
    {
        return $this->belongsTo(Soil::class);
    }

    public function generalHabitat()
    {
        return $this->belongsTo(General::class)->whereType('habitat');
    }

    public function plantingCondition()
    {
        return $this->belongsToMany(
            PlantingCondition::class,
            'botanical_planting_conditions',
            'botanical_id',
            'planting_condition_id'
        )->whereNull('botanical_planting_conditions.deleted_at')
            ->withTimestamps();
    }
}
