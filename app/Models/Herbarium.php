<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\HerbariumScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kalnoy\Nestedset\NodeTrait;

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
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_phenology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_origin_id",
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
 *          property="general_phytogeography_id",
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
 *          property="general_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering_time",
 *          description="flowering_time",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="general_group_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_growth_id",
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
    use HerbariumScope,NodeTrait;

    public static $linguistically = ['flowering' => false,'habitat_description' => false,'ecology_description' => false,'life_forms'=>false];
    public static $rules = [
//        'location_id' => 'required|exists:locations,id',
        'protection_id' => 'exists:protections,id',
        'organization_id' => 'required|exists:organizations,id',
        'plant_id' => 'required|exists:plants,id',
        'sheets_no' => 'integer',
        'samples_no' => 'integer',
        'tip_qt' => 'integer',
        'physical_tip_qt' => 'integer',
        'tip_type' => 'string',
        'is_flowering' => 'integer',
        'herbarium_tip_location' => 'integer',
        'type_description' => 'string',
//        'general_type_id' => 'exists:generals,id',
        'general_group_id' => 'exists:generals,id',
        'general_ecology_id' => 'exists:generals,id',
        'general_habitat_id' => 'exists:generals,id',
        'general_origin_id' => 'exists:generals,id',
//        'general_growth_id' => 'exists:generals,id',
        'general_phytogeography_id' => 'exists:generals,id',
        'general_phenology_id' => 'exists:generals,id',
        'number' => 'integer',
        'life_form_leaf_id' => 'required|exists:life_forms,id',
        'life_form_cycle_id' => 'required|exists:life_forms,id',
        'life_form_cycle_id' => 'required|exists:life_forms,id',

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
        'organization_description' => 'json',
        'habitat_description' => 'json',
        'ecology_description' => 'json',
        'life_forms'=>'json'
    ];


    /**
     * @param null $parameter
     * @return HasMany
     */
    public function actionHubs($parameter=null): HasMany
    {
        return $this->hasMany(ActionHub::class,'herbarium_id','id')
            ->when($parameter,function ($query,$parameter){
               return $query->ofAction($parameter);
        })->latest();
    }
    /**
     * @param null $parameter
     * @return HasMany
     */
    public function plantApplication($parameter=null): HasMany
    {
        return $this->hasMany(PlantApplication::class,'herbarium_id','id')
            ->when($parameter,function ($query,$parameter){
               return $query->ofAction($parameter);
        })->latest();
    }

    /**
     * @return MorphToMany
     */
    public function action(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable','action_hubs');
    }

    /**
     * @return MorphMany
     */
    public function borrows(): MorphMany
    {
        return $this->morphMany(Borrow::class, 'borrowable');
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function actions(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable','action_hubs');
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
     * @return MorphMany
     */
    public function exchange(): MorphMany
    {
        return $this->morphMany(Exchange::class, 'exchangeable')->latest();
    }
    /**
     * @return HasMany
     */
    public function sendHerbariumExchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, 'send_herbarium_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function recieveHerbariumExchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, 'recieve_herbarium_id')->latest();
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
        return $this->morphMany(Media::class,'mediable')->latest();
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

    public function generalType()
    {
        return $this->belongsTo(General::class, 'general_type_id');
    }

    public function generalEcology()
    {
        return $this->belongsTo(General::class, 'general_ecology_id');
    }

    public function generalHabitat()
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    public function generalOrigin()
    {
        return $this->belongsTo(General::class, 'general_origin_id');
    }


    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function department()
    {
        return $this->morphToMany(Department::class,'departmentable','department_hubs');
    }

    public function generalGroup()
    {
        return $this->belongsTo(General::class,
            'general_group_id');
    }

    public function generalPhytogeography()
    {
        return $this->belongsTo(General::class, 'general_phytogeography_id');
    }


    public function leafLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_leaf_id');
    }

    public function woodenLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_wooden_id');
    }

    public function cycleLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_cycle_id');
    }

    public function herbaceousLifeForm(): BelongsTo
    {
        return $this->belongsTo(LifeForm::class,
            'life_form_herbaceous_id');
    }

}
