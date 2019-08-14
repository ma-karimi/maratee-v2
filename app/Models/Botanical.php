<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="Botanical",
 *            required={"herbarium_id"},
 * 			@SWG\Property(property="herbarium_id", type="integer"),
 * 			@SWG\Property(property="height", type="float"),
 * 			@SWG\Property(property="weight_k", type="integer"),
 * 			@SWG\Property(property="flower_color", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="fruit_color", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="leaf_color", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="seed_germination", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="treatment", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="growth_rate", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="first_flowering", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="flowering_period", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="first_seeding", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="seed_rate", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="seed_production", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="season_tolerance", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="year", type="string"),
 * 			@SWG\Property(property="sensitivity", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="sensitivity_description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="notes", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="planting", type="string"),
 * 			@SWG\Property(property="cutting_rooting_per", type="integer"),
 * 			@SWG\Property(property="entry_type", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Botanical extends BaseModel
{
    public static $linguistically=['flower_color'=>false,'fruit_color'=>false,'leaf_color'=>false,'seed_germination'=>false,'treatment'=>false,'growth_rate'=>false,'first_flowering'=>false,'flowering_period'=>false,'first_seeding'=>false,'seed_rate'=>false,'seed_production'=>false,'sensitivity'=>false,'sensitivity_description'=>false,'notes'=>false,'entry_type'=>false];
    public static $rules = [
        'year' => 'date',
        'planting'=>'date',
        'cutting_rooting_per'=>'integer',
    ];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'entry_type', 'first_flowering', 'first_seeding', 'flower_color', 'flowering_period', 'fruit_color', 'growth_rate', 'height', 'herbarium_id', 'leaf_color', 'notes', 'planting', 'cutting_rooting_per', 'season_tolerance', 'seed_production', 'seed_rate', 'sensitivity', 'sensitivity_description', 'seed_germination', 'treatment', 'updated_at', 'year'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'height' => 'float',
        'flower_color' => 'json',
        'fruit_color' => 'json',
        'leaf_color' => 'json',
        'seed_germination' => 'json',
        'treatment' => 'json',
        'growth_rate' => 'json',
        'first_flowering' => 'json',
        'flowering_period' => 'json',
        'first_seeding' => 'json',
        'seed_rate' => 'json',
        'seed_production' => 'json',
        'season_tolerance' => 'json',
        'sensitivity' => 'json',
        'sensitivity_description' => 'json',
        'notes' => 'json',
        'entry_type' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'planting', 'updated_at', 'year'];


    public function botanicalGardenActions()
    {
        return $this->hasMany(BotanicalGardenAction::class)->latest();
    }

    public function botanicalIrrigations($season=null)
    {
        return $this->hasMany(BotanicalIrrigation::class)
            ->when($season,function ($query,$season){
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

    public function herbarium()
    {
        return $this->belongsTo(Herbarium::class);
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
        );
    }
    public function soil_from()
    {
        return $this->belongsToMany(
            Soil::class,
            'botanical_garden_actions',
            'botanical_id',
            'from_soil_id'
        )->with('soilFeatures');
    }
    public function soil_to()
    {
        return $this->belongsToMany(
            Soil::class,
            'botanical_garden_actions',
            'botanical_id',
            'to_soil_id'
        )->with('soilFeatures');
    }
    public function lighting_from()
    {
        return $this->belongsToMany(
            Lighting::class,
            'botanical_garden_actions',
            'botanical_id',
            'from_lighting_id'
        );
    }
    public function lighting_to()
    {
        return $this->belongsToMany(
            Lighting::class,
            'botanical_garden_actions',
            'botanical_id',
            'to_lighting_id'
        );
    }

}
