<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="Botanical",
 *            required={"taxonomy_id"},
 *
 */
class Botanical extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    public const GROWTH_RATES = [1 => 'very low', 2 => 'low', 3 => 'moderate', 4 => 'fast', 5 => 'very fast'];
    public const SEED_RATE = [1 => 'low', 2 => 'moderate', 3 => 'good', 4 => 'bumper'];
    public const SEED_FORMATION = [1 => 'yes', 2 => 'no'];
    public const WINTER_TOLERANCE = [1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving', 6 => 'minimum temperature'];
    public const SUMMER_TOLERANCE = [1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving'];

    public const ENTRANCE_TO_GARDEN = [1 => 'seedling', 2 => 'plant', 3 => 'bulb', 4 => 'bulbil', 5 => 'tuber', 6 => 'rhizome', 7 => 'softwood cutting', 8 => 'hardwood cutting', 9 => 'root cutting', 10 => 'graft-division', 11 => 'meristem', 12 => 'spore'];
    public const SOIL = [1 => 'neutral', 2 => 'alkaline', 3 => 'acid', 4 => 'indifferent'];
//    public const PLANT_CONDITION = [1 => 'full sun', 2 => 'light shade', 3 => 'moderate shade', 4 => 'deep shade', 5 => 'greenhouse', 6 => 'fancing N', 7 => 'fancing W', 8 => 'fancing S', 9 => 'fancing E'];


    public const WOODEN = [1 => 'Tree', 2 => 'Shrub'];
    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    public const SEED_GERMINATION = [1 => 'good', 2 => 'moderate', 3 => 'low', 4 => 'none'];
    public const CYCLE = [1 => 'evergreen', 2 => 'deciduous', 3 => 'semi deciduous', 4 => 'annual climber', 5 => 'perennial climber', 6 => 'annual herb', 7 => 'biennial herb', 8 => 'perennial herb', 9 => 'bulb', 10 => 'tuber', 11 => 'rhizome', 12 => 'water plant'];

    public static $rules = [
        'cutting_rooting' => 'numeric',
        'flower_color' => 'string',
        'fruit_color' => 'string',
        'foliage_color' => 'string',
        'seed_germination_id' => 'integer',
        'treatment' => 'string',
        'comments' => 'string',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'garden_map' => 'string',
        'general_habitat_id' => 'integer|exists:generals,id',
        'general_originِ_id' => 'integer|exists:generals,id',
        'monopoly_of_iran_id' => 'numeric',
        'wooden_id' => 'integer',
        'cycle_id' => 'integer',
        'protection_id' => 'integer|exists:protections,id',
        'internal_habitat_id' => 'integer|exists:internal_habitats,id',
        'entrance_to_garden_id' => 'integer',
        'growth_rate_id' => 'integer',
        'first_flowering' => 'nullable|date',
//        'first_seeding' => 'date',
        'seed_rate_id' => 'integer',
        'seed_formation_id' => 'integer',
        'winter_tolerance_id' => 'integer',
        'summer_tolerance_id' => 'integer',
        'sensitivity_conditions' => 'string',
        'soil_id' => 'integer',
    ];


    protected $appends = ['soil', 'summer_tolerance', 'winter_tolerance',
        'seed_formation', 'seed_germination', 'seed_rate', 'growth_rate', 'entrance_to_garden', 'cycle', 'wooden', 'monopoly_of_iran'];

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
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'planting', 'updated_at', 'first_seeding', 'first_flowering'];


    public function operations()
    {
        return $this->hasMany(BotanicalOperation::class)->latest();
    }

    public function values()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 1);
    }

    public function usages()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 2);
    }

    public function propagations()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 3);
    }

    public function plantingConditions()
    {
        return $this->hasMany(BotanicalProperty::class)->latest()->where('type_id', 4);
    }


    public function botanicalIrrigation()
    {
        return $this->hasOne(BotanicalIrrigation::class);
    }

    public function getMonopolyOfIranAttribute()
    {
        return !empty($this->attributes['monopoly_of_iran_id']) ? Arr::get(self::BOOLEAN, $this->attributes['monopoly_of_iran_id']) : null;
    }

    public function getSoilAttribute()
    {
        return !empty($this->attributes['soil_id']) ? Arr::get(self::SOIL, $this->attributes['soil_id']) : null;
    }

    public function getGrowthRateAttribute()
    {
        return !empty($this->attributes['growth_rate_id']) ? Arr::get(self::GROWTH_RATES, $this->attributes['growth_rate_id']) : null;
    }

    public function getSeedRateAttribute()
    {
        return !empty($this->attributes['seed_rate_id']) ? Arr::get(self::SEED_RATE, $this->attributes['seed_rate_id']) : null;
    }

    public function getSeedFormationAttribute()
    {
        return !empty($this->attributes['seed_formation_id']) ? Arr::get(self::GROWTH_RATES, $this->attributes['seed_formation_id']) : null;
    }

    public function getWinterToleranceAttribute()
    {
        return !empty($this->attributes['winter_tolerance_id']) ? Arr::get(self::WINTER_TOLERANCE, $this->attributes['winter_tolerance_id']) : null;
    }

    public function getSummerToleranceAttribute()
    {
        return !empty($this->attributes['summer_tolerance_id']) ? Arr::get(self::SUMMER_TOLERANCE, $this->attributes['summer_tolerance_id']) : null;
    }

    public function getWoodenAttribute()
    {
        return !empty($this->attributes['wooden_id']) ? Arr::get(self::WOODEN, $this->attributes['wooden_id']) : null;
    }

    public function getCycleAttribute()
    {
        return !empty($this->attributes['cycle_id']) ? Arr::get(self::CYCLE, $this->attributes['cycle_id']) : null;
    }

    public function getSeedGerminationAttribute()
    {
        return !empty($this->attributes['seed_germination_id']) ? Arr::get(self::SEED_GERMINATION, $this->attributes['seed_germination_id']) : null;
    }


    public function generalHabitat()
    {
        return $this->belongsTo(General::class)->whereType('habitat');
    }
    public function generalSamples()
    {
        return $this->belongsToMany(General::class, 'palebotany_samples')->whereType('sample');
    }

    public function internal_habitat()
    {
        return $this->belongsTo(InternalHabitat::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->where('is_herbarium', 1);
    }

    public function distributions(): MorphToMany
    {
        return $this->morphToMany(Geographical::class, 'distributable', 'distribution_hubs')
            ->whereNull('distribution_hubs.deleted_at')
            ->withTimestamps();
    }
}
