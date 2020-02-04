<?php

namespace App\Models;

use App\Models\Accessor\BotanicalAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\BotanicalRelation;
use App\Models\Scope\BotanicalScope;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="Botanical",
 *            required={"taxonomy_id"},
 *
 */
class Botanical extends BaseModel implements HasMedia, AuditableContract
{
    use HasMediaTrait, BotanicalAccessor, BotanicalRelation, BotanicalScope, Auditable, AuditTrait;

    public const SEED_FORMATION = [1 => 'yes', 2 => 'no'];


    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];


    public static $rules = [
        'cutting_rooting' => 'nullable|numeric',
        'flower_color' => 'nullable|string',
        'fruit_color' => 'nullable|string',
        'foliage_color' => 'nullable|string',
        'seed_germination_id' => 'nullable|exists:botanical_generals,id',
        'treatment' => 'nullable|string',
        'comments' => 'nullable|string',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'collection_id' => 'required|exists:botanical_generals,id',
        'general_habitat_id' => 'nullable|integer|exists:generals,id',
        'originِ_id' => 'nullable|exists:botanical_generals,id',
//        'monopoly_of_iran_id' => 'nullable|numeric',
        'wooden_id' => 'nullable|exists:botanical_generals,id',
        'protection_id' => 'nullable|integer|exists:protections,id',
        'growth_rate_id' => 'nullable|exists:botanical_generals,id',
        'first_flowering' => 'nullable|date',
        'first_seeding' => 'nullable|date',
        'seed_rate_id' => 'nullable|exists:botanical_generals,id',
        'seed_formation_id' => 'nullable|integer',
        'winter_tolerance_id' => 'nullable|exists:botanical_generals,id',
        'summer_tolerance_id' => 'nullable|exists:botanical_generals,id',
        'sensitivity_conditions' => 'nullable|string',
        'soil_id' => 'nullable|exists:botanical_generals,id',
    ];


    protected $appends = [

        'seed_formation', 'geographicals',
        'cycle', 'value', 'propagation', 'plant_condition', 'usage', 'flower_color', 'fruit_color', 'foliage_color', 'seeding', 'planting', 'transfer', 'habitat', 'origin', 'garden', 'internal_habitat', 'last_audit'
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
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'planting', 'updated_at', 'first_seeding', 'first_flowering'];
    protected $with = ['audits'];

}
