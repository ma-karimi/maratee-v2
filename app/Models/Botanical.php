<?php

namespace App\Models;

use App\Models\Accessor\BotanicalAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\BotanicalRelation;
use App\Models\Scope\BotanicalScope;
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
    use HasMediaTrait, BotanicalAccessor, BotanicalRelation, BotanicalScope;
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
        'cutting_rooting' => 'nullable|numeric',
        'flower_color' => 'nullable|string',
        'fruit_color' => 'nullable|string',
        'foliage_color' => 'nullable|string',
        'seed_germination_id' => 'nullable|integer',
        'treatment' => 'nullable|string',
        'comments' => 'nullable|string',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'garden_map' => 'nullable|string',
        'general_habitat_id' => 'nullable|integer|exists:generals,id',
        'general_originِ_id' => 'nullable|integer|exists:generals,id',
        'monopoly_of_iran_id' => 'nullable|numeric',
        'wooden_id' => 'nullable|integer',
        'cycle_id' => 'nullable|integer',
        'protection_id' => 'nullable|integer|exists:protections,id',
        'internal_habitat_id' => 'nullable|integer|exists:internal_habitats,id',
        'entrance_to_garden_id' => 'nullable|integer',
        'growth_rate_id' => 'nullable|integer',
        'first_flowering' => 'nullable|date',
//        'first_seeding' => 'date',
        'seed_rate_id' => 'nullable|integer',
        'seed_formation_id' => 'nullable|integer',
        'winter_tolerance_id' => 'nullable|integer',
        'summer_tolerance_id' => 'nullable|integer',
        'sensitivity_conditions' => 'nullable|string',
        'soil_id' => 'nullable|integer',
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



}
