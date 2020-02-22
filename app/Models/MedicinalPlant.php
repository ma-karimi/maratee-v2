<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalPlantRelations;
use App\Models\Scope\MedicinalPlantScope;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"taxonomy_id"},
 * )
 */
class MedicinalPlant extends BaseModel implements HasMedia, AuditableContract
{
    use MedicinalPlantAccessor, MedicinalPlantScope, MedicinalPlantRelations, HasMediaTrait, Auditable, AuditTrait;

    public const TRADITIONAL_IRANIAN_MEDICINE = [0 => 'unknown', 1 => 'raw', 2 => 'processed', 3 => 'raw & processed'];
    public const NATURAL_DRUG = [0 => 'unknown', 1 => 'human medicines', 2 => 'animal drugs'];
    public const INHERBAL_MEDICINE_STORE = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const EXPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const IMPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];


    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    public const WOODEN = [1 => 'Tree', 2 => 'Shrubs', 3 => 'Bush'];
    public const HERBACEOUS = [1 => 'Standing', 2 => 'Crawling'];
    public const CYCLE = [1 => 'Annual', 2 => 'Perennial', 3 => 'Biennal'];

    public static $rules = [
        'herbarium_number' => 'nullable|string',
        'taxonomy_id' => 'required|exists:taxonomies,id',
//        'aerial_part_id' => 'nullable|exists:medicinal_parts,id',
        'ground_part_id' => 'nullable|exists:medicinal_parts,id',
        'general_origin_id' => 'nullable|exists:generals,id',
        'presence_in_country' => 'nullable|integer',

        //Medicinal Location
        'height' => 'nullable|string',
        'medicinal_properties' => 'nullable|string',
//        //life_form
        'cycle_id' => 'nullable|exists:life_forms,id',
        'wooden_id' => 'nullable|exists:life_forms,id',
        'herbaceous_id' => 'nullable|exists:life_forms,id',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plants';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'efficiency' => 'float',
    ];

    protected $appends = [
        'traditional_iranian_medicine_name',
        'natural_drug_name',
        'inherbal_medicine_store_name',
        'exporting_name',
        'importing_name',
        'cultivated_area',
        'hygienic_cosmetic',
        'distributions',
        'wooden',
        'herbaceous',
        'cycle',
        'pharmaceuticals',
        'other_products',
        'distributions',
        'potentials',
        'foods',
        'industries',
        'materials',
        'last_audit',
        'aerial_type'
    ];

    protected $with = ['audits'];
}
