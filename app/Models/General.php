<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="General",
 *      required={"name","type"}
 * )
 */
class General extends BaseModel
{
    use GeneralScope;
    public static $rules = array(
        'name' => 'required|string',
        'type' => 'required|string',
        'parent_id' => 'integer',
    );

    public const TYPES = ['phytogeography', 'phenology', 'plant_type', 'species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'sperm', 'cotyledon', 'growth', 'usage', 'part', 'industry', 'application', 'habitat', 'ecology', 'origin', 'lichen', 'moss', 'diatom', 'biological'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable','actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
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
        return $this->belongsToMany(Plant::class,
            'plant_properties',
            'general_id',
            'plant_id')->withTimestamps();
    }

    /**
     * @return HasOne
     */
    public function varietyAuthor(): HasOne
    {
        return $this->hasOne(VarietyAuthorView::class, 'general_id');
    }
    /**
     * @return HasOne
     */
    public function speciesAuthor(): HasOne
    {
        return $this->hasOne(SpeciesAuthorView::class, 'general_id');
    }
    /**
     * @return HasOne
     */
    public function subSpeciesAuthor(): HasOne
    {
        return $this->hasOne(SubSpeciesAuthorView::class, 'general_id');
    }
}
