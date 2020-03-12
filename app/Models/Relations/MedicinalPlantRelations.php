<?php


namespace App\Models\Relations;


use App\Models\{General, MedicinalPart, MedicinalPlantType, Taxonomy};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MedicinalPlantRelations
{


    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

    public function groundType()
    {
        return $this->belongsTo(MedicinalPart::class, 'ground_part_id'
        )->where('type_id', array_search('ground', MedicinalPart::TYPE));
    }


    public function aerialTypes()
    {
        return $this->morphedByMany(MedicinalPart::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_parts.type_id', array_search('aerial', MedicinalPart::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
    }

    public function properties()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_hubs', 'medicinal_plant_id'
        )->where('medicinal_plant_types.type_id', array_search('properties', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_hubs.deleted_at');
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
