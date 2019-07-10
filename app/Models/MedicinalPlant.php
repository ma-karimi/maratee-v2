<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicinalPlant extends BaseModel
{


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
