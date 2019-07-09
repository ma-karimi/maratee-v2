<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Botanical extends BaseModel
{
    const BOTANICAL_ID = 'botanical_id';


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
    protected $fillable = ['created_at', 'deleted_at', 'entry_type', 'first_flowering', 'first_seeding', 'flower_color', 'flowring_interval', 'fruit_color', 'growth_rate', 'height', 'herbarium_id', 'leaf_color', 'notes', 'planting', 'scion_rooting_per', 'season_resistance', 'seed_production', 'seed_value', 'sensitivity', 'sensitivity_description', 'sprout', 'treatment', 'updated_at', 'year'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'height' => 'double',
        'requirement' => 'json',
        'flower_color' => 'json',
        'fruit_color' => 'json',
        'leaf_color' => 'json',
        'sprout' => 'json',
        'treatment' => 'json',
        'growth_rate' => 'json',
        'first_flowering' => 'json',
        'flowring_interval' => 'json',
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
        return $this->hasMany(BotanicalGardenAction::class, self::BOTANICAL_ID)->latest();
    }

    public function botanicalIrrigations()
    {
        return $this->hasMany(BotanicalIrrigation::class, self::BOTANICAL_ID)->latest();
    }

    public function botanicalReproductions()
    {
        return $this->hasMany(BotanicalReproduction::class, self::BOTANICAL_ID)->latest();
    }

    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class, self::BOTANICAL_ID)->latest();
    }
}
