<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicinalPlantMorphology extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plant_morphologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'medicinal_plant_id', 'morphology_id', 'updated_at', 'value'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['value' => 'json'];


    /**
     * @return BelongsTo
     */
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

    /**
     * @return BelongsTo
     */
    public function morphology(): BelongsTo
    {
        return $this->belongsTo(Morphology::class);
    }
}
