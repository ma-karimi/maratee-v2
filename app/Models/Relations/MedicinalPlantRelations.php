<?php


namespace App\Models\Relations;


use App\Models\{ActionHub,
    Article,
    General,
    Location,
    MedicinalPart,
    MedicinalPlantConstituent,
    MedicinalPlantType,
    Medicine,
    Method,
    Product,
    Province,
    Taxonomy};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MedicinalPlantRelations
{


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
        )->where('type_id', array_search('aerial', MedicinalPart::TYPE));
    }

    public function groundType()
    {
        return $this->belongsTo(MedicinalPart::class, 'ground_part_id'
        )->where('type_id', array_search('ground', MedicinalPart::TYPE));
    }

    public function foodIndustry()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'food_industry_id'
        )->where('type_id', array_search('food_industry', MedicinalPlantType::TYPE));
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
        )->where('type_id', 1);
    }

    public function extraction()
    {
        return $this->belongsTo(Method::class, 'method_extraction_id'
        )->where('type_id', 2);
    }

    public function analyse()
    {
        return $this->belongsTo(Method::class, 'method_analyse_id'
        )->where('type_id', 3);
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
