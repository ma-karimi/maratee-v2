<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="PlantApplication",
 *      required={"herbarium_id"},
 *      @SWG\Property(
 *          property="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="habitat_description",
 *          type="array",
 *          @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="ecology_description",
 *          type="array",
 *          @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_part_id",
 *          description="general_part_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_application_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_growth_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_usage_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_industry_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_ecology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_habitat_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_origin_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="presence",
 *          description="presence",
 *          type="array",
 *     @SWG\Items(type="string")
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
class PlantApplication extends BaseModel
{

    public static $linguistically = ['presence' => false];
    public static $rules = [
        'herbarium_id' => 'required|exists:herbariums,id',
        'general_part_id' => 'required|exists:generals,id',
        'general_application_id' => 'required|exists:generals,id',
        'general_growth_id' => 'required|exists:generals,id',
        'general_usage_type_id' => 'required|exists:generals,id',
        'general_industry_id' => 'required|exists:generals,id',
        'general_ecology_id' => 'required|exists:generals,id',
        'general_habitat_id' => 'required|exists:generals,id',
        'general_origin_id' => 'required|exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_applications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['general_application_id', 'created_at', 'deleted_at', 'herbarium_id', 'general_growth_id', 'general_industry_id', 'general_part_id', 'general_usage_type_id', 'general_ecology_id', 'general_habitat_id', 'general_origin_id', 'presence', 'updated_at', 'habitat_description', 'ecology_description'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'presence' => 'json',
        'habitat_description'=>'json',
        'ecology_description'=>'json'
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
    public function generalApplication(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_application_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalGrowth(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_growth_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalIndustry(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_industry_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalPart(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_part_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalUsage(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_usage_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalEcology(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_ecology_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalHabitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalOrigin(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_origin_id');
    }

}
