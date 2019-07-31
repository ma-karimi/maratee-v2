<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"name","plant_general_family_id","plant_general_genus_id","plant_general_cotyledon_id"},
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
 *          property="plant_general_sub_specie_id",
 *          description="plant_general_sub_specie_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_variety_id",
 *          description="plant_general_variety_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_specie_id",
 *          description="plant_general_specie_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_class_id",
 *          description="plant_general_class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_group_id",
 *          description="plant_general_group_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_order_id",
 *          description="plant_general_order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_flowering_id",
 *          description="plant_general_flowering_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_sperm_id",
 *          description="plant_general_sperm_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_family_id",
 *          description="plant_general_family_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_genus_id",
 *          description="plant_general_genus_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_general_cotyledon_id",
 *          description="plant_general_cotyledon_id",
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
 *          property="author_id",
 *          description="author_id",
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

    public static $linguistically=['name'=>true,'description'=>false,'domestic_name'=>false];

    public static $rules=[
        'user_id' => 'exists:users,id',
        'article_id' => 'exists:articles,id',
        'author_id' => 'exists:authors,id',
        'location_id' => 'exists:locations,id',
        'plant_general_cotyledon_id' => 'required|exists:plant_generals,id',
        'plant_general_genus_id' => 'required|exists:plant_generals,id',
        'plant_general_family_id' => 'required|exists:plant_generals,id',
        'plant_general_sperm_id' => 'exists:plant_generals,id',
        'plant_general_flowering_id' => 'exists:plant_generals,id',
        'plant_general_order_id' => 'exists:plant_generals,id',
        'plant_general_group_id' => 'exists:plant_generals,id',
        'plant_general_class_id' => 'exists:plant_generals,id',
        'plant_general_specie_id' => 'exists:plant_generals,id',
        'plant_general_variety_id' => 'exists:plant_generals,id',
        'plant_general_sub_specie_id' => 'exists:plant_generals,id',
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
    protected $fillable = ['article_id', 'author_id', 'created_at', 'deleted_at', 'description', 'domestic_name', 'location_id', 'name', 'plant_general_class_id', 'plant_general_cotyledon_id', 'plant_general_family_id', 'plant_general_flowering_id', 'plant_general_genus_id', 'plant_general_group_id', 'plant_general_order_id', 'plant_general_specie_id', 'plant_general_sperm_id', 'plant_general_sub_specie_id', 'plant_general_variety_id', 'updated_at', 'user_id'];


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


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
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
    public function plantGeneral(): BelongsTo
    {
        return $this->belongsTo(General::class,
            [
                'plant_general_class_id',
                'plant_general_family_id',
                'plant_general_flowering_id',
                'plant_general_genus_id',
                'plant_general_group_id',
                'plant_general_order_id',
                'plant_general_specie_id',
                'plant_general_sperm_id',
                'plant_general_sub_specie_id',
                'plant_general_variety_id',
                'plant_general_cotyledon_id',
            ]);
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
     * @return HasOne
     */
    public function herbarium(): HasOne
    {
        return $this->hasOne(Herbarium::class);
    }
}
