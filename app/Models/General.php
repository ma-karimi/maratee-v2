<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Validation\Rule;

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
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
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
    public static $linguistically=['name'=>true,'description'=>false];
    public static $rules= array(
        'type' => 'required|string',
        'parent_id' => 'integer',
    );


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'type', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];
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
        return $this->morphToMany(Author::class, 'morph_author')->withTimestamps();
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
        return $this->hasMany(__CLASS__, 'parent_id')->where('type','genus');
    }
    /**
     * @return HasMany
     */
    public function genusChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type','genus');
    }
    /**
     * @return HasMany
     */
    public function speciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type','genus');
    }
    /**
     * @return HasMany
     */
    public function subspeciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type','genus');
    }
}
