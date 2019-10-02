<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"taxonomy_id", "location_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="plant_herbarium_id",
 *          description="from herbariums selected plant",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="aerial_part_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="ground_part_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="food_industry_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="general_origin_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="general_habitat_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="hygienic_cosmetic_industry_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="industrial_potential_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="general_phenology_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="method_distillation_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="method_extraction_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="method_analyse_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="secondary_metabolite_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="effective_material_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="traditional_iranian_medicine",
 *          description="traditional_iranian_medicine",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="natural_drug",
 *          description="natural_drug",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="inherbal_medicine_store",
 *          description="inherbal_medicine_store",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="exporting",
 *          description="exporting",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="importing",
 *          description="importing",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="cultivated_area",
 *          description="cultivated_area",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="studied_sample",
 *          description="studied_sample",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="presence_in_country",
 *          description="presence_in_country",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicinal_properties",
 *          description="medicinal_properties",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="side_effects",
 *          description="side_effects",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="medicine_id",
 *          description="medicine_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="consumption",
 *          description="consumption",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="active_compounds",
 *          description="active_compounds",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="manufacturer",
 *          description="manufacturer",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="efficiency",
 *          description="efficiency",
 *          type="number",
 *      ),
 *      @SWG\Property(
 *          property="code_no",
 *          description="code_no",
 *          type="number",
 *      ),
 *      @SWG\Property(
 *          property="flower_color",
 *          description="flower_color",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="fruit_color",
 *          description="fruit_color",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="height",
 *          description="height (cm)",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class MedicinalPlant extends BaseModel
{
    use MedicinalPlantAccessor, ArticleRelation;

    public const TRADITIONAL_IRANIAN_MEDICINE = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const NATURAL_DRUG = [0 => 'unknown', 1 => 'human medicines', 2 => 'animal drugs'];
    public const INHERBAL_MEDICINE_STORE = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const EXPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const IMPORTING = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const CULTIVATED_AREA = [0 => 'unknown', 1 => 'raw', 2 => 'processed'];
    public const STUDIED_SAMPLE = [0 => 'unknown', 1 => 'wild', 2 => 'cultivated'];
    public const PRESENCE_IN_COUNTRY = [0 => 'unknown', 1 => 'native', 2 => 'endemic'];

    public static $rules = [
//        'plant_herbarium_id' => 'required|exists:plant_herbariums,id',
        'taxonomy_id' => 'exists:taxonomies,id',
        'location_id' => 'exists:locations,id',
        'aerial_part_id' => 'exists:medicinal_parts,id',
        'ground_part_id' => 'exists:medicinal_parts,id',
        'food_industry_id' => 'exists:medicinal_plant_types,id',
        'general_origin_id' => 'exists:generals,id',
        'general_habitat_id' => 'exists:generals,id',
        'hygienic_cosmetic_industry_id' => 'exists:medicinal_plant_types,id',
        'other_industry_id' => 'exists:medicinal_plant_types,id',
        'industrial_potential_id' => 'exists:medicinal_plant_types,id',
        'general_phenology_id' => 'exists:generals,id',
        'method_distillation_id' => 'exists:methods,id',
        'method_extraction_id' => 'exists:methods,id',
        'method_analyse_id' => 'exists:methods,id',
        'secondary_metabolite_id' => 'exists:medicinal_plant_types,id',
        'effective_material_id' => 'exists:medicinal_plant_types,id',
        'pharmaceutical_form_id' => 'exists:medicinal_plant_types,id',
        'product_id' => 'exists:products,id',
        'medicine_id' => 'exists:medicines,id',
        'traditional_iranian_medicine' => 'integer',
        'natural_drug' => 'integer',
        'inherbal_medicine_store' => 'integer',
        'exporting' => 'integer',
        'importing' => 'integer',
        'cultivated_area' => 'integer',
        'studied_sample' => 'integer',
        'presence_in_country' => 'integer',
        'code_no' => 'integer',
        'height' => 'string',
    ];
    public static $linguistically = [
        'medicinal_properties' => false,
        'side_effects' => false,
        'consumption' => false,
        'active_compounds' => false,
        'manufacturer' => false,
        'fruit_color' => false,
        'flower_color' => false,
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
        'medicinal_properties' => 'json',
        'side_effects' => 'json',
        'consumption' => 'json',
        'active_compounds' => 'json',
        'manufacturer' => 'json',
        'efficiency' => 'float',
        'fruit_color' => 'json',
        'flower_color' => 'json',
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
    ];


    /**
     * @return MorphMany
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'modelable');
    }

    /**
     * @return HasMany
     */
    public function medicinalPlantConstituents(): HasMany
    {
        return $this->hasMany(MedicinalPlantConstituent::class)->latest();
    }

    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(TreatmentHub::class, 'treamentable');
    }

    public function medicinalPlantType()
    {
        return $this->belongsToMany(MedicinalPlantType::class,
            'medicinal_plant_properties',
            'medicinal_plant_id',
            'medicinal_plant_type_id'
        )->whereNull('medicinal_plant_properties.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function plant(): BelongsTo
    {
        return $this->belongsTo(PlantHerbarium::class);
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }
    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function aerialType()
    {
        return $this->belongsTo(MedicinalPart::class, 'aerial_part_id'
        )->where('type', array_search('aerial', MedicinalPart::TYPE));
    }

    public function groundType()
    {
        return $this->belongsTo(MedicinalPart::class, 'ground_part_id'
        )->where('type', array_search('ground', MedicinalPart::TYPE));
    }

    public function foodIndustry()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'food_industry_id'
        )->where('type_id', array_search('food_industry', MedicinalPlantType::TYPE));
    }

    public function hygienicCosmeticIndustry()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'hygienic_cosmetic_industry_id'
        )->where('type_id', array_search('hygienic cosmetic', MedicinalPlantType::TYPE));
    }

    public function otherIndustry()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'other_industry_id'
        )->where('type_id', array_search('other_industry', MedicinalPlantType::TYPE));
    }

    public function industrialPotential()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'industrial_potential_id'
        )->where('type_id', array_search('industrial_potential', MedicinalPlantType::TYPE));
    }

    public function phenology()
    {
        return $this->belongsTo(General::class, 'general_phenology_id'
        )->where('type', 'phenology');
    }
    public function origin()
    {
        return $this->belongsTo(General::class, 'general_origin_id'
        )->where('type', 'origin');
    }

    public function distillation()
    {
        return $this->belongsTo(Method::class, 'method_distillation_id'
        )->where('name->en', 'LIKE', '%distillation%');
    }

    public function extraction()
    {
        return $this->belongsTo(Method::class, 'method_extraction_id'
        )->where('name->en', 'LIKE', '%extraction%');
    }

    public function analyse()
    {
        return $this->belongsTo(Method::class, 'method_analyse_id'
        )->where('name->en', 'LIKE', '%analyse%');
    }

    public function secondaryMetabolite()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'secondary_metabolite_id'
        )->where('type_id', array_search('secondary_metabolite', MedicinalPlantType::TYPE));
    }

    public function effectiveMaterial()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'effective_material_id'
        )->where('type_id', array_search('material', MedicinalPlantType::TYPE));
    }

    public function pharmaceuticalForm()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'pharmaceutical_form_id'
        )->where('type_id', array_search('pharmaceutical', MedicinalPlantType::TYPE));
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return MorphToMany
     */
    public function transactions(): MorphToMany
    {
        return $this->morphToMany(Transaction::class, 'transactionable', 'transaction_hubs')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }
}
