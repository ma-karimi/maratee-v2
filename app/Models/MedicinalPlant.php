<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="MedicinalPlant",
 *      required={"herbarium_id","location_id","method_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_origin_id",
 *          description="plant_origin_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code_no",
 *          description="code_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="treatment",
 *          description="treatment",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="vast_cultivation",
 *          description="vast_cultivation",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="studied_sample",
 *          description="studied_sample",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="secondary_metabolite",
 *          description="secondary_metabolite",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="efficiency",
 *          description="efficiency",
 *          type="number",
 *          format="double"
 *      ),
 *      @SWG\Property(
 *          property="exclusivity",
 *          description="exclusivity",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="life_cycle",
 *          description="life_cycle",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="acidity",
 *          description="acidity",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="method_id",
 *          description="method_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="article_id",
 *          description="article_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="soil_id",
 *          description="soil_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="media_id",
 *          description="media_id",
 *          type="integer",
 *          format="int32"
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
class MedicinalPlant extends BaseModel
{

    public static $rules=[
        'plant_origin_id' => 'integer',
        'code_no' => 'integer',
        'efficiency' => 'numeric',
        'herbarium_id' => 'required|exists:herbariums,id',
        'location_id' => 'required|exists:locations,id',
        'method_id' => 'required|exists:methods,id',
        'article_id' => 'exists:methods,id',
        'soil_id' => 'integer',
        'media_id' => 'integer',

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['acidity', 'article_id', 'code_no', 'created_at', 'deleted_at', 'efficiency', 'exclusivity', 'herbarium_id', 'life_cycle', 'location_id', 'media_id', 'method_id', 'plant_origin_id', 'secondary_metabolite', 'soil_id', 'studied_sample', 'treatment', 'updated_at', 'vast_cultivation'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json',
        'vast_cultivation' => 'json',
        'studied_sample' => 'json',
        'efficiency' => 'double',
        'secondary_metabolite' => 'json',
        'exclusivity' => 'json',
        'life_cycle' => 'json',
        'acidity' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

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
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return BelongsTo
     */
    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }

    /**
     * @return BelongsTo
     */
    public function plantFactor(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_origin_id');
    }

    /**
     * @return BelongsTo
     */
    public function soil(): BelongsTo
    {
        return $this->belongsTo(Soil::class);
    }

    /**
     * @return HasMany
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medicinalPlantConstituents(): HasMany
    {
        return $this->hasMany(MedicinalPlantConstituent::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medicinalPlantMorphologies(): HasMany
    {
        return $this->hasMany(MedicinalPlantMorphology::class)->latest();
    }

}
