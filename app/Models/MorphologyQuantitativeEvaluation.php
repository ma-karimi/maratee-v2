<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="MorphologyQuantitativeEvaluation",
 *      required={"seed_id"},
 * )
 */
class MorphologyQuantitativeEvaluation extends BaseModel
{
    public static $rules = [
        'seed_collection_id' => 'required|exists:seed_collections,id',
        'collection_id' => 'required|exists:seed_generals,id',
        'specimen_type_id' => 'required|exists:seed_generals,id',
        'morphology_field_id' => 'required|exists:morphology_fields,id',
        'planting_date' => 'nullable|date',
        'observation_date' => 'nullable|date',
        'days_of_start_flowering' => 'nullable|integer',
        'days_to_flowering' => 'nullable|integer',
        'days_to_seed_ripening' => 'nullable|integer',
    ];


    public function variables()
    {
        return $this->morphToMany(MorphologyVariable::class, 'morphology');
    }

    public function morphologyField()
    {
        return $this->belongsTo(MorphologyField::class);
    }


    /**
     * @return BelongsTo
     */
    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class);
    }

    /**
     * @return BelongsTo
     */
    public function specimenType()
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }
    /**
     * @return BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 19);
    }

    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
