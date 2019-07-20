<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            name="Assessment",
 *            required={"herbarium_id"},
 * 			@SWG\Property(name="herbarium_id", type="integer"),
 * 			@SWG\Property(name="height", type="float"),
 * 			@SWG\Property(name="weight_k", type="integer"),
 * 			@SWG\Property(name="flower_color", type="array"),
 * 			@SWG\Property(name="fruit_color", type="array"),
 * 			@SWG\Property(name="leaf_color", type="array"),
 * 			@SWG\Property(name="sprout", type="array"),
 * 			@SWG\Property(name="treatment", type="array"),
 * 			@SWG\Property(name="growth_rate", type="array"),
 * 			@SWG\Property(name="first_flowering", type="array"),
 * 			@SWG\Property(name="flowering_interval", type="array"),
 * 			@SWG\Property(name="first_seeding", type="array"),
 * 			@SWG\Property(name="seed_value", type="array"),
 * 			@SWG\Property(name="seed_production", type="array"),
 * 			@SWG\Property(name="season_resistance", type="array"),
 * 			@SWG\Property(name="year", type="string"),
 * 			@SWG\Property(name="sensitivity", type="array"),
 * 			@SWG\Property(name="sensitivity_description", type="array"),
 * 			@SWG\Property(name="notes", type="array"),
 * 			@SWG\Property(name="planting", type="string"),
 * 			@SWG\Property(name="scion_rooting_per", type="integer"),
 * 			@SWG\Property(name="entry_type", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Botanical extends BaseModel
{

    public static $rules = [
        'year' => 'date',
        'planting'=>'date',
        'scion_rooting_per'=>'integer',
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
    protected $fillable = ['created_at', 'deleted_at', 'entry_type', 'first_flowering', 'first_seeding', 'flower_color', 'flowering_interval', 'fruit_color', 'growth_rate', 'height', 'herbarium_id', 'leaf_color', 'notes', 'planting', 'scion_rooting_per', 'season_resistance', 'seed_production', 'seed_value', 'sensitivity', 'sensitivity_description', 'sprout', 'treatment', 'updated_at', 'year'];


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
        'sprout' => 'json',
        'treatment' => 'json',
        'growth_rate' => 'json',
        'first_flowering' => 'json',
        'flowering_interval' => 'json',
        'first_seeding' => 'json',
        'seed_value' => 'json',
        'seed_production' => 'json',
        'season_resistance' => 'json',
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

    public function botanicalIrrigations()
    {
        return $this->hasMany(BotanicalIrrigation::class)->latest();
    }

    public function botanicalReproductions()
    {
        return $this->hasMany(BotanicalReproduction::class)->latest();
    }

    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class)->latest();
    }
}
