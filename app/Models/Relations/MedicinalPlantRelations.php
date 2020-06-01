<?php


namespace App\Models\Relations;


use App\Models\{General, MedicinalPart, MedicinalPlantType, Taxonomy};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait MedicinalPlantRelations
{


    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

    public function groundType(): BelongsTo
    {
        return $this->belongsTo(MedicinalPart::class, 'ground_part_id'
        )->where('type_id', array_search('ground', MedicinalPart::TYPE));
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_origin_id'
        )->where('type', 'origin');
    }

    public function aerialTypes(): MorphToMany
    {
        return $this->morphedByMany(MedicinalPart::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_parts.type_id', array_search('aerial', MedicinalPart::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }

    public function properties(): MorphToMany
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_plant_types.type_id', array_search('properties', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }


    public function habitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id'
        )->where('type', 'habitat');
    }

    /**
     * @return mixed
     * @deprecated by dr.sefidkon
     */
    public function effectiveMaterials(): MorphToMany
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs'
        )->where('medicinal_plant_types.type_id', array_search('material', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }


    /**
     * @return MorphToMany
     */
    public function secondaryMetabolites(): MorphToMany
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs'
        )->where('medicinal_plant_types.type_id', array_search('secondary_metabolite', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }


}
