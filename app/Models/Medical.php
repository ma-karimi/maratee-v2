<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medical extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'drug_description', 'drug_shape_description', 'drug_usage_description', 'herbarium_id', 'medicinal_part_description', 'medicine_drug_id', 'medicine_drug_shape_id', 'medicine_drug_usage_id', 'medicine_effect_description', 'medicine_effect_id', 'medicine_medicinal_part_id', 'medicine_side_effect_id', 'medicine_therapy_id', 'product_id', 'side_effect_description', 'therapy_description', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'side_effect_description' => 'json',
        'medicine_effect_description' => 'json',
        'therapy_description' => 'json',
        'drug_description' => 'json',
        'drug_shape_description' => 'json',
        'medicinal_part_description' => 'json',
        'drug_usage_description' => 'json',
    ];


    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }

    /**
     * @return BelongsTo
     */
    public function medicineDrug(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_drug_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineDrugShape(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_drug_shape_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineDrugUsage(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_drug_usage_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineEffect()
    {
        return $this->belongsTo(Medicine::class, 'medicine_effect_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineMedicinalPart(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_medicinal_part_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineSideEffect(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_side_effect_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineTherapy(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_therapy_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
