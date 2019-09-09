<?php

namespace App\Models;

use App\Models\Accessor\HerbariumAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Scope\HerbariumScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @SWG\Definition(
 *      definition="Herbarium",
 *      required={"general_habitat_id","general_phytogeography_id","life_forms","organization_id", "plant_id"},
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
 *          property="number",
 *          description="number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_origin_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_phytogeography_id",
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
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="habitat_description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="ecology_description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="organization_description",
 *          description="organization_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="life_forms",
 *          description="life_forms",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="growth_rate",
 *          type="number",
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_lichen_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_diatom_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_substrate_moss_id",
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
    use HerbariumScope, NodeTrait, HerbariumAccessor;

    public const GROWTH_RATES = [0 => 'unknown', 1 => 'very low', 2 => 'low', 3 => 'moderate', 4 => 'fast', 5 => 'very fast'];

    public static $linguistically = ['flowering' => false];
    public static $rules = [
        'organization_id' => 'required|exists:organizations,id',
        'plant_id' => 'required|exists:plants,id',
        'sheets_no' => 'integer|max:2147483647',
        'samples_no' => 'integer|max:2147483647',
        'tip_qt' => 'integer',
        'physical_tip_qt' => 'integer',
//        'tip_type' => 'string',
        'herbarium_tip_location' => 'integer',
        'type_description' => 'string',
//        'general_type_id' => 'exists:generals,id',

//        'general_growth_id' => 'exists:generals,id',
        'number' => 'integer',

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbariums';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];


    /**
     * @param null $parameter
     * @return HasMany
     */
    public function actionHubs($parameter = null): HasMany
    {
        return $this->hasMany(ActionHub::class, 'herbarium_id', 'id')
            ->when($parameter, function ($query, $parameter) {
                return $query->ofAction($parameter);
            })->latest();
    }

    /**
     * @param null $parameter
     * @return HasMany
     */
    public function plantApplication($parameter = null): HasMany
    {
        return $this->hasMany(HerbariumApplication::class, 'herbarium_id', 'id')
            ->when($parameter, function ($query, $parameter) {
                return $query->ofAction($parameter);
            })->latest();
    }

    /**
     * @return MorphToMany
     */
    public function action(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable', 'action_hubs');
    }

    public function actions(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable', 'action_hubs');
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
    public function seeds(): HasMany
    {
        return $this->hasMany(Seed::class)->latest();
    }


    /**
     * @return MorphMany
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->latest();
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function generalType()
    {
        return $this->belongsTo(General::class, 'general_type_id');
    }




    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function department()
    {
        return $this->morphToMany(Department::class, 'departmentable', 'department_hubs');
    }



    /**
     * @return MorphToMany
     */
    public function transactions(): MorphToMany
    {
        return $this->morphToMany(Transaction::class, 'transactionable','transaction_hubs')
            ->withTimestamps()
            ->withPivot(['type_id','sheets_no']);
    }
}
