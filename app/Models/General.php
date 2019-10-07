<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="General",
 *      required={"name","type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type: 'phytogeography', 'phenology', 'plant_type', 'species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'sperm', 'cotyledon', 'growth', 'usage', 'part', 'industry', 'application', 'habitat', 'ecology', 'origin', 'lichen', 'moss', 'diatom', 'substrate', 'biological'",
 *          type="string"
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
class General extends BaseModel
{
    use GeneralScope;
    public static $rules = array(
        'type' => 'required|string',
        'parent_id' => 'integer',
    );

//
//    /**
//     * @return HasMany
//     */
//    public function herbariums(): HasMany
//    {
//        return $this->hasMany(Herbarium::class, 'general_group_id')->latest();
//    }
//
//    /**
//     * @return HasMany
//     */
//    public function plants(): HasMany
//    {
//        return $this->hasMany(Plant::class, [
//            'general_class_id',
//            'general_family_id',
//            'general_flowering_id',
//            'general_genus_id',
//            'general_group_id',
//            'general_order_id',
//            'general_specie_id',
//            'general_sperm_id',
//            'general_sub_specie_id',
//            'general_variety_id',
//            'general_cotyledon_id',
//        ])->latest();
//    }

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable','actor_hubs')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function genusParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function speciesParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function subspeciesParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function varietyParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return HasMany
     */
    public function familyChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function genusChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function speciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function subspeciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    public function plants(): BelongsToMany
    {
        return $this->belongsToMany(PlantHerbarium::class,
            'plant_properties',
            'general_id',
            'plant_id')->withTimestamps();
    }
}
