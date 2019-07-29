<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Herbarium",
 *      required={"location_id","organization_id", "plant_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="number",
 *          description="number",
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
 *          property="plantologies_phenology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="protection_id",
 *          description="protection_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plantologies_phytogeography_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="organization_id",
 *          description="organization_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sheets_no",
 *          description="sheets_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="samples_no",
 *          description="samples_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tip_qt",
 *          description="tip_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="physical_tip_qt",
 *          description="physical_tip_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tip_type",
 *          description="tip_type",
 *          type="string"
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
 *          property="is_flowering",
 *          description="is_flowering",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="organization_description",
 *          description="organization_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="herbarium_tip_location",
 *          description="herbarium_tip_location",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type_description",
 *          description="type_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="plantologies_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering",
 *          description="flowering",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="plant_generals_group_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
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
class Herbarium extends BaseModel
{
    public static $rules = [
        'location_id' => 'required|exists:locations,id',
        'protection_id' => 'exists:protections,id',
        'organization_id' => 'required|exists:organizations,id',
        'plant_id' => 'required|exists:plants,id',
        'plantologies_phytogeography_id' => 'exists:plantologies,id',
        'plantologies_phenology_id' => 'exists:plantologies,id',
        'sheets_no' => 'integer',
        'samples_no' => 'integer',
        'tip_qt' => 'integer',
        'physical_tip_qt' => 'integer',
        'tip_type' => 'string',
        'is_flowering' => 'integer',
        'herbarium_tip_location' => 'integer',
        'type_description' => 'string',
        'plantologies_type_id' => 'exists:plantologies,id',
        'plant_generals_group_id' => 'exists:plant_generals,id',
        'number' => 'integer',

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbariums';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'flowering', 'herbarium_tip_location', 'is_flowering', 'location_id', 'name', 'number', 'organization_description', 'organization_id', 'plantologies_phenology_id', 'physical_tip_qt', 'plantologies_phytogeography_id', 'plant_generals_group_id', 'plantologies_type_id', 'protection_id', 'samples_no', 'sheets_no', 'plant_id', 'tip_qt', 'tip_type', 'type_description', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'flowering' => 'json',
        'organization_description' => 'json',
    ];


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
    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class)->latest();
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
    public function cryoBanks(): HasMany
    {
        return $this->hasMany(CryoBank::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function exchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, ['send_herbarium_id', 'receive_herbarium_id'])->latest();
    }

    /**
     * @return HasMany
     */
    public function seeds(): HasMany
    {
        return $this->hasMany(Seed::class, 'herbarium_id')->latest();
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
    public function medicals(): HasMany
    {
        return $this->hasMany(Medical::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }

    public function phenology()
    {
        return $this->belongsTo(Paleontology::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function protection()
    {
        return $this->belongsTo(Protection::class);
    }

    public function plantType()
    {
        return $this->belongsTo(Paleontology::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function plantGroup()
    {
        return $this->belongsTo(PlantGeneral::class);
    }

    public function phytogeography()
    {
        return $this->belongsTo(Paleontology::class);
    }
}
