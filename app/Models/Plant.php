<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"name","general_family_id","general_genus_id","general_cotyledon_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="domestic_name",
 *          description="domestic_name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="general_sub_specie_id",
 *          description="general_sub_specie_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_variety_id",
 *          description="general_variety_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_specie_id",
 *          description="general_specie_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_class_id",
 *          description="general_class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_group_id",
 *          description="general_group_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_order_id",
 *          description="general_order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_flowering_id",
 *          description="general_flowering_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_sperm_id",
 *          description="general_sperm_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_family_id",
 *          description="general_family_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_genus_id",
 *          description="general_genus_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_cotyledon_id",
 *          description="general_cotyledon_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
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
 *          property="location_id",
 *          description="location_id",
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
class Plant extends BaseModel
{
    use PlantScope;

    public static $linguistically = ['name' => true, 'description' => false, 'domestic_name' => false];

    public static $rules = [
        'user_id' => 'exists:users,id',
        'article_id' => 'exists:articles,id',
        'location_id' => 'exists:locations,id',
        'general_cotyledon_id' => 'required|exists:generals,id',
        'general_genus_id' => 'required|exists:generals,id',
        'general_family_id' => 'required|exists:generals,id',
        'general_sperm_id' => 'exists:generals,id',
        'general_flowering_id' => 'exists:generals,id',
        'general_order_id' => 'exists:generals,id',
        'general_group_id' => 'exists:generals,id',
        'general_class_id' => 'exists:generals,id',
        'general_specie_id' => 'exists:generals,id',
        'general_variety_id' => 'exists:generals,id',
        'general_sub_specie_id' => 'exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'created_at', 'deleted_at', 'description', 'domestic_name', 'location_id', 'name', 'general_class_id', 'general_cotyledon_id', 'general_family_id', 'general_flowering_id', 'general_genus_id', 'general_group_id', 'general_order_id', 'general_specie_id', 'general_sperm_id', 'general_sub_specie_id', 'general_variety_id', 'updated_at', 'user_id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'domestic_name' => 'json',
    ];

    protected $with = ['seeds', 'article', 'location', 'generalFlowering', 'generalVariety', 'generalSpecie', 'generalOrder', 'generalClass', 'generalGroup', 'generalGenus', 'generalSperm', 'generalCotyledon', 'user', 'seedPlants', 'herbariums', 'authors'];


    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Author::class, 'morph_author');
    }

    public function seeds(): BelongsToMany
    {
        return $this->belongsToMany(Seed::class,
            'seed_plants',
            'plant_id',
            'seed_id');
    }

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
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function generalFlowering(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_flowering_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalVariety(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_variety_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalSpecie(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_specie_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalOrder(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_order_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalClass(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_class_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalGroup(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_group_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalGenus(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_genus_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalSperm(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_sperm_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalCotyledon(): BelongsTo
    {
        return $this->belongsTo(General::class,
            'general_cotyledon_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function seedPlants(): HasMany
    {
        return $this->hasMany(SeedPlant::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function herbariums(): HasMany
    {
        return $this->hasMany(Herbarium::class);
    }
}
