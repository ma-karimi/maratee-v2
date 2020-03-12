<?php


namespace App\Models\Relations;


use App\Models\{General,
    MedicinalLocation,
    MedicinalPart,
    MedicinalPlantType,
    Medicine,
    Plant,
    PlantGeographical,
    Product,
    Taxonomy};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MedicinalApplicationRelations
{


    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
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


}
