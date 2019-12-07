<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalPlantRelations;
use App\Models\Scope\MedicinalPlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"taxonomy_id", "location_id"},
 * )
 */
class MedicinalPlant extends BaseModel
{
    use MedicinalPlantAccessor, MedicinalPlantScope, MedicinalPlantRelations;

    public const TRADITIONAL_IRANIAN_MEDICINE = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const NATURAL_DRUG = [0 => 'unknown', 1 => 'human medicines', 2 => 'animal drugs'];
    public const INHERBAL_MEDICINE_STORE = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const EXPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const IMPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const CULTIVATED_AREA = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const STUDIED_SAMPLE = [0 => 'unknown', 1 => 'wild', 2 => 'cultivated'];
    public const PRESENCE_IN_COUNTRY = [0 => 'unknown', 1 => 'native', 2 => 'endemic'];
    public const WOODEN = [1 => 'Tree', 2 => 'Shrubs'];
    public const HERBACEOUS = [1 => 'Standing', 2 => 'Crawling'];
    public const CYCLE = [1 => 'Annual', 2 => 'Perennial'];
    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    public static $rules = [
        'herbarium_number' => 'nullable|string',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'aerial_part_id' => 'nullable|exists:medicinal_parts,id',
        'ground_part_id' => 'nullable|exists:medicinal_parts,id',
        'general_origin_id' => 'nullable|exists:generals,id',
        'secondary_metabolite_id' => 'nullable|exists:medicinal_plant_types,id',
        'effective_material_id' => 'nullable|exists:medicinal_plant_types,id',
        'presence_in_country' => 'integer',
        'code_no' => 'integer',
        'height' => 'string',
        'medicinal_properties' => 'string',
        'side_effects' => 'string',
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
        'cultivated_area_name',
        'studied_sample_name',
        'presence_in_country_name',
        'wooden',
        'herbaceous',
        'cycle',
        'hygienic_cosmetic',
        'distributions'
    ];
}
