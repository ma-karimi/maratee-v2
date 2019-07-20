<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Location",
 *      required={"address_id","name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="address_id",
 *          description="address_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="region_id",
 *          description="region_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="altitude",
 *          description="altitude",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="point",
 *          description="point",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
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
class Location extends BaseModel
{

    use SpatialTrait;

    public static $rules=[
        'address_id' => 'required|exists:addresses,id',
        'region_id' => 'exists:regions,id',
        'altitude' => 'integer'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * @var array
     */
    protected $spatialFields = [
        'point'
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['address_id', 'altitude', 'created_at', 'deleted_at', 'description', 'name', 'point', 'region_id', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];


    /**
     * @var array
     */
    public static $messages = [
        'address_id.required'=>'آدرس الزامی است'
    ];

    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return HasMany
     */
    public function actionHubs(): HasMany
    {
        return $this->hasMany(ActionHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function articleHubs(): HasMany
    {
        return $this->hasMany(ArticleHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function herbariums(): HasMany
    {
        return $this->hasMany(Herbarium::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class)->latest();
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
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedChemicals(): HasMany
    {
        return $this->hasMany(SeedChemical::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs(): HasMany
    {
        return $this->hasMany(SeedHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedMoleculars(): HasMany
    {
        return $this->hasMany(SeedMolecular::class)->latest();
    }
}
