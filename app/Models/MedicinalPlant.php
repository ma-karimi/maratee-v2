<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalPlantRelations;
use App\Models\Scope\MedicinalPlantScope;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"taxonomy_id"},
 * )
 */
class MedicinalPlant extends BaseModel implements HasMedia, AuditableContract
{
    use MedicinalPlantAccessor, MedicinalPlantScope, MedicinalPlantRelations, InteractsWithMedia, Auditable, AuditTrait;



    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    public const WOODEN = [1 => 'Tree', 2 => 'Shrubs', 3 => 'Bush'];

    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id|unique:medicinal_plants',
        'ground_part_id' => 'nullable|exists:medicinal_parts,id',
        'general_origin_id' => 'nullable|exists:generals,id',

        //Medicinal Location
        'height' => 'nullable|string',
        'medicinal_properties' => 'nullable|string',
        'wooden_id' => 'nullable|exists:life_forms,id',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plants';


    protected $appends = [
        'wooden',
        'metabolites',
        'medicinal_properties',
        'last_audit',
        'aerial_type'
    ];

    protected $with = ['audits','taxonomy'];
}
