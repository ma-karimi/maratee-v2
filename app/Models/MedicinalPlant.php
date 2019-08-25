<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
 *          property="plant_application_id",
 *          description="plant_application_id",
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
 *          property="cultivated_area",
 *          description="cultivated_area",
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
 *          property="phenology_stage",
 *          description="phenology_stage",
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
 *          property="used_origin",
 *          description="used_origin",
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
 *          property="used_type",
 *          description="used_type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="store_type",
 *          description="store_type",
 *          type="string",
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
        'store_type' => 'string',
        'location_id' => 'required|exists:locations,id',
        'article_id' => 'exists:methods,id',

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_plants';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json',
        'vast_cultivation' => 'json',
        'cultivated_area' => 'json',
        'studied_sample' => 'json',
        'efficiency' => 'double',
        'secondary_metabolite' => 'json',
        'exclusivity' => 'json',
        'life_cycle' => 'json',
        'phenology_stage' => 'json',
        'used_origin' => 'json',
        'used_type' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function plantApplication(): BelongsTo
    {
        return $this->belongsTo(PlantApplication::class);
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


    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(ArticleHub::class, 'articleable');
    }


    /**
     * @return MorphToMany
     */
    public function locations(): MorphToMany
    {
        return $this->morphToMany(LocationHub::class, 'locationable');
    }

    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(TreatmentHub::class, 'treamentable');
    }
}
