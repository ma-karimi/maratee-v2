<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @SWG\Definition(
 *      definition="Medical",
 *      required={"plant_application_id","medicine_effect_id","medicine_medicinal_part_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="plant_application_id",
 *          description="plant_application_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_side_effect_id",
 *          description="medicine_side_effect_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_therapy_id",
 *          description="medicine_therapy_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_drug_id",
 *          description="medicine_drug_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_effect_id",
 *          description="medicine_effect_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="product_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_shape_id",
 *          description="medicine_shape_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_part_id",
 *          description="medicine_part_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="medicine_usage_id",
 *          description="medicine_usage_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="side_effect_description",
 *          description="side_effect_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="usage_description",
 *          description="usage_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="part_description",
 *          description="part_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="shape_description",
 *          description="shape_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="drug_description",
 *          description="drug_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="therapy_description",
 *          description="therapy_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="effect_description",
 *          description="effect_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Medical extends BaseModel
{

    public static $linguistically=['effect_description'=>true,'therapy_description'=>true,'drug_description'=>true,'shape_description'=>true,'part_description'=>true,'usage_description'=>true];
    public static $rules=[
        'plant_application_id' => 'required|exists:plant_applications,id',
        'medicine_side_effect_id' => 'required|exists:medicines,id',
        'medicine_effect_id' => 'required|exists:medicines,id',
        'medicine_therapy_id' => 'required|exists:medicines,id',
        'medicine_drug_id' => 'required|exists:medicines,id',
        'product_id' => 'required|exists:products,id',
        'medicine_shape_id' => 'required|exists:medicines,id',
        'medicine_part_id' => 'required|exists:medicines,id',
        'medicine_usage_id' => 'required|exists:medicines,id'
    ];
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
    protected $fillable = ['created_at', 'deleted_at', 'drug_description', 'shape_description', 'usage_description', 'plant_application_id', 'part_description', 'medicine_drug_id', 'medicine_shape_id', 'medicine_usage_id', 'effect_description', 'medicine_effect_id', 'medicine_part_id', 'medicine_side_effect_id', 'medicine_therapy_id', 'product_id', 'side_effect_description', 'therapy_description', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'side_effect_description' => 'json',
        'effect_description' => 'json',
        'therapy_description' => 'json',
        'drug_description' => 'json',
        'shape_description' => 'json',
        'part_description' => 'json',
        'usage_description' => 'json',
    ];


    /**
     * @return BelongsTo
     */
    public function plantApplication(): BelongsTo
    {
        return $this->belongsTo(PlantApplication::class);
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
        return $this->belongsTo(Medicine::class, 'medicine_shape_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicineDrugUsage(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_usage_id');
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
        return $this->belongsTo(Medicine::class, 'medicine_part_id');
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


    /**
     * @return BelongsToMany
     */
    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, 'medical_components');
    }
}
