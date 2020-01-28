<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->morphToMany(SeedGeneral::class, 'morphology', 'morphology_variables')->withPivot('value')->whereNull('morphology_variables.deleted_at');
    }

    public function morphologyField()
    {
        return $this->belongsTo(SeedMorphologyField::class);
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
