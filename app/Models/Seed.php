<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Seed",
 *      required={"herbarium_id","protection_id","department_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
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
 *          property="field_code",
 *          description="field_code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="correct_field_code",
 *          description="correct_field_code",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="sample_code",
 *          description="sample_code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="voucher_no",
 *          description="voucher_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="transmittance",
 *          description="transmittance",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="land_form",
 *          description="land_form",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="slope_direction",
 *          description="slope_direction",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="landscape",
 *          description="landscape",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="slope_degree",
 *          description="slope_degree",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="soil_depth",
 *          description="soil_depth",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="density",
 *          description="density",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="drainage",
 *          description="drainage",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="soil_ph",
 *          description="soil_ph",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="salinity",
 *          description="salinity",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="lime",
 *          description="lime",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="climate",
 *          description="climate",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="extent_population",
 *          description="extent_population",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="vegetation",
 *          description="vegetation",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="soil_erosion",
 *          description="soil_erosion",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="land_reforming",
 *          description="land_reforming",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="sample_type",
 *          description="sample_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="flowering",
 *          description="flowering",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="pollination",
 *          description="pollination",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="pollination_agent",
 *          description="pollination_agent",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="fruit_type",
 *          description="fruit_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="seeding_bush_qt",
 *          description="seeding_bush_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="collecting_type",
 *          description="collecting_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="seeding_month",
 *          description="seeding_month",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="reproduction",
 *          description="reproduction",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="vegetative_form",
 *          description="vegetative_form",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="height",
 *          description="height",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="mother_health",
 *          description="mother_health",
 *           type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="send_date",
 *          description="send_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="collected_qt",
 *          description="collected_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="must_collected_qt",
 *          description="must_collected_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="critical_extensions_qt",
 *          description="critical_extensions_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="notes",
 *          description="notes",
 *          type="array",
	 *     @SWG\Items(type="string")
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

class Seed extends BaseModel
{
    public static $linguistically=['transmittance'=>false,'land_form'=>false,'slope_direction'=>false,'landscape'=>false,'soil_depth'=>false,'density'=>false,'drainage'=>false,'soil_ph'=>false,'salinity'=>false,'lime'=>false,'climate'=>false,'extent_population'=>false,'vegetation'=>false,'soil_erosion'=>false,'land_reforming'=>false,'sample_type'=>false,'flowering'=>false,'pollination'=>false,'pollination_agent'=>false,'fruit_type'=>false,'collecting_type'=>false,'seeding_month'=>false,'reproduction'=>false,'vegetative_form'=>false,'mother_health'=>false,'notes'=>false];
    public static $rules=[
        'herbarium_id' => 'required|exists:herbariums,id',
        'protection_id' => 'required|exists:protections,id',
        'department_id' => 'required|exists:departments,id',
        'field_code' => 'integer',
        'sample_code' => 'integer',
        'voucher_no' => 'integer',
        'slope_degree' => 'integer',
        'seeding_bush_qt' => 'integer',
        'height' => 'integer',
        'collected_qt' => 'integer',
        'must_collected_qt' => 'integer',
        'critical_extensions_qt' => 'integer',
        'send_date' => 'date',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seeds';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['climate', 'collected_qt', 'collecting_type', 'correct_field_code', 'created_at', 'critical_extensions_qt', 'deleted_at', 'density', 'department_id', 'drainage', 'extent_population', 'field_code', 'flowering', 'fruit_type', 'height', 'herbarium_id', 'land_form', 'land_reforming', 'landscape', 'lime', 'mother_health', 'must_collected_qt', 'notes', 'pollination', 'pollination_agent', 'protection_id', 'reproduction', 'salinity', 'sample_code', 'sample_type', 'seeding_bush_qt', 'seeding_month', 'send_date', 'slope_degree', 'slope_direction', 'soil_depth', 'soil_erosion', 'soil_ph', 'transmittance', 'updated_at', 'vegetation', 'vegetative_form', 'voucher_no'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'transmittance' => 'json',
        'land_form' => 'json',
        'slope_direction' => 'json',
        'landscape' => 'json',
        'soil_depth' => 'json',
        'density' => 'json',
        'drainage' => 'json',
        'soil_ph' => 'json',
        'salinity' => 'json',
        'lime' => 'json',
        'climate' => 'json',
        'extent_population' => 'json',
        'vegetation' => 'json',
        'soil_erosion' => 'json',
        'land_reforming' => 'json',
        'sample_type' => 'json',
        'flowering' => 'json',
        'pollination' => 'json',
        'pollination_agent' => 'json',
        'fruit_type' => 'json',
        'collecting_type' => 'json',
        'seeding_month' => 'json',
        'reproduction' => 'json',
        'vegetative_form' => 'json',
        'mother_health' => 'json',
        'notes' => 'json',
    ];

    public function assessmentCollections()
    {
        return $this->hasMany(AssessmentCollection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs()
    {
        return $this->hasMany(SeedHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedExchanges()
    {
        return $this->hasMany(SeedExchange::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedTechnologies()
    {
        return $this->hasMany(SeedTechnology::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedMoleculars()
    {
        return $this->hasMany(SeedMolecular::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedChemicals()
    {
        return $this->hasMany(SeedChemical::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medias()
    {
        return $this->hasMany(Media::class)->latest();
    }

    public function geramins()
    {
        return $this->hasMany(Geramin::class)->latest();
    }

    public function herbarium()
    {
        return $this->belongsTo(Herbarium::class, 'herbarium_id');
    }

    public function protection()
    {
        return $this->belongsTo(Protection::class, 'protection_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function plants()
    {
        return $this->belongsToMany(Plant::class,
            'seed_plants',
            'seed_id',
            'plant_id');
    }
}
