<?php


namespace App\Models\Relations;


use App\Models\{General,
    Geographical,
    MedicinalLocation,
    MedicinalPart,
    MedicinalPlantType,
    Medicine,
    Plant,
    PlantGeographical,
    Product,
    Province,
    Taxonomy};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MedicinalPlantRelations
{

    public function provinces()
    {
        return $this->hasManyThrough(PlantGeographical::class, Plant::class, 'taxonomy_id', 'plant_id');
//        return $this->morphedByMany(Province::class,
//            'hub',
//            'medicinal_hubs', 'medicinal_plant_id'
//        )->whereNull('medicinal_hubs.deleted_at')
//            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(MedicinalLocation::class);
    }

    public function medicines()
    {
        return $this->morphedByMany(Medicine::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id')->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id')->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
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

    public function foodIndustries()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_plant_types.type_id', array_search('food_industry', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }

    public function otherIndustries()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_plant_types.type_id', array_search('other_industry', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }

    public function industrialPotentials()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_plant_types.type_id', array_search('industrial_potential', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
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


    public function effectiveMaterials()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs'
        )->where('medicinal_plant_types.type_id', array_search('material', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }


}
