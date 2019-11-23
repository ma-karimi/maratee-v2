<?php

namespace App\Models;

use App\Models\Accessor\MedicinalPlantAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"taxonomy_id", "location_id"},
 * )
 */
class MedicinalPlant extends BaseModel
{
    use MedicinalPlantAccessor;

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

    public static $rules = [
        'herbarium_number' => 'string',
        'article_id' => 'exists:articles,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'location_id' => 'exists:locations,id',
        'aerial_part_id' => 'nullable|exists:medicinal_parts,id',
        'ground_part_id' => 'nullable|exists:medicinal_parts,id',
        'treatment_id' => 'nullable|exists:medicinal_plant_types,id',
        'food_industry_id' => 'nullable|exists:medicinal_plant_types,id',
        'general_origin_id' => 'nullable|exists:generals,id',
        'hygienic_cosmetic_industry_id' => 'nullable|exists:medicinal_plant_types,id',
        'other_industry_id' => 'nullable|exists:medicinal_plant_types,id',
        'industrial_potential_id' => 'nullable|exists:medicinal_plant_types,id',
        'phenology_id' => 'nullable|exists:medicinal_plant_types,id',
        'method_distillation_id' => 'exists:methods,id',
        'method_extraction_id' => 'nullable|exists:methods,id',
        'method_analyse_id' => 'nullable|exists:methods,id',
        'secondary_metabolite_id' => 'nullable|exists:medicinal_plant_types,id',
        'effective_material_id' => 'nullable|exists:medicinal_plant_types,id',
        'pharmaceutical_form_id' => 'nullable|exists:medicinal_plant_types,id',
        'product_id' => 'nullable|exists:products,id',
        'medicine_id' => 'nullable|exists:medicines,id',
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
        'medicinal_properties' => 'string',
        'side_effects' => 'string',
//        //life_form
//        'cycle_id' => 'nullable|exists:life_forms,id',
//        'wooden_id' => 'nullable|exists:life_forms,id',
//        'herbaceous_id' => 'nullable|exists:life_forms,id',
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
        'cycle'
    ];


    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }


    /**
     * @return HasMany
     */
    public function medicinalPlantConstituents(): HasMany
    {
        return $this->hasMany(MedicinalPlantConstituent::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

//
//    public function cycle()
//    {
//        return $this->belongsTo(LifeForm::class, 'cycle_id');
//    }
//
//    public function wooden()
//    {
//        return $this->belongsTo(LifeForm::class, 'wooden_id');
//    }
//
//    public function herbaceous()
//    {
//        return $this->belongsTo(LifeForm::class, 'herbaceous_id');
//    }

    public function medicinalPlantType()
    {
        return $this->belongsToMany(MedicinalPlantType::class,
            'medicinal_plant_properties',
            'medicinal_plant_id',
            'medicinal_plant_type_id'
        )->whereNull('medicinal_plant_properties.deleted_at')
            ->withTimestamps();
    }

    public function provinces(): BelongsToMany
    {
        return $this->belongsToMany(Province::class,
            'medicinal_plant_provinces',
            'medicinal_plant_id',
            'province_id'
        )->whereNull('medicinal_plant_provinces.deleted_at')
            ->withTimestamps();
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

    public function treatment()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'treatment_id'
        )->where('type_id', array_search('treatment', MedicinalPlantType::TYPE));
    }

    public function industrialPotential()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'industrial_potential_id'
        )->where('type_id', array_search('industrial_potential', MedicinalPlantType::TYPE));
    }

    public function origin()
    {
        return $this->belongsTo(General::class, 'general_origin_id'
        )->where('type', 'origin');
    }

    public function habitat()
    {
        return $this->belongsTo(General::class, 'general_habitat_id'
        )->where('type', 'habitat');
    }

    public function distillation()
    {
        return $this->belongsTo(Method::class, 'method_distillation_id'
        )->where('type_id',1);
    }

    public function extraction()
    {
        return $this->belongsTo(Method::class, 'method_extraction_id'
        )->where('type_id',2);
    }

    public function analyse()
    {
        return $this->belongsTo(Method::class, 'method_analyse_id'
        )->where('type_id',3);
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

    public function phenology()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'phenology_id'
        )->where('type_id', array_search('stage_of_phenology', MedicinalPlantType::TYPE));
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
}
