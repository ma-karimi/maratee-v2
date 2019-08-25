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
 *          description="correct_field_code",
 *         type="string",
 *      ),
 *      @SWG\Property(
 *          property="correct_field_code",
 *          description="correct_field_code",
 *         type="string",
 *      ),
 *      @SWG\Property(
 *          property="voucher_no",
 *          description="voucher_no",
 *          type="string"
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
 *          property="slope_action",
 *          description="slope_action",
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
 *          property="soil_texture",
 *          description="soil_texture",
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
 *          property="community_type",
 *          description="community_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="associated_species",
 *          description="associated_species",
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
 *          property="area_sampled",
 *          description="area_sampled",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plants_sampled_no",
 *          description="area_sampled",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plants_found_no",
 *          description="area_sampled",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="specimen_type",
 *          description="specimen_type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="date_flowering",
 *          description="date_flowering",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="pollination_type",
 *          description="pollination_type",
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
 *          property="seed_collected_from",
 *          description="seed_collected_from",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="date_harvesting",
 *          description="date_harvesting",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="accession_code",
 *          description="accession_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="life_span",
 *          description="life_span",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="growth_form",
 *          description="growth_form",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="plant_height",
 *          description="plant_height",
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
 *          property="seed_advise",
 *          description="seed_advise",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="other_detail",
 *          description="other_detail",
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
    public static $linguistically=['seed_advise'=>false,'transmittance'=>false,'land_form'=>false,'slope_action'=>false,'landscape'=>false,'soil_depth'=>false,'soil_texture'=>false,'drainage'=>false,'soil_ph'=>false,'salinity'=>false,'lime'=>false,'climate'=>false,'community_type'=>false,'associated_species'=>false,'soil_erosion'=>false,'area_sampled'=>false,'specimen_type'=>false,'date_flowering'=>false,'pollination_type'=>false,'pollination_agent'=>false,'fruit_type'=>false,'seed_collected_from'=>false,'date_harvesting'=>false,'life_span'=>false,'growth_form'=>false,'mother_health'=>false,'other_detail'=>false];
    public static $rules=[
        'herbarium_id' => 'required|exists:herbariums,id',
        'protection_id' => 'required|exists:protections,id',
        'department_id' => 'required|exists:departments,id',
        'plant_application_id' => 'exists:plant_applications,id',
        'field_code' => 'string',
        'correct_field_code' => 'string',
        'accession_code' => 'string',
        'voucher_no' => 'integer',
        'slope_degree' => 'integer',
        'plant_height' => 'integer'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seeds';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'seed_advise'=>'json',
        'transmittance' => 'json',
        'land_form' => 'json',
        'slope_action' => 'json',
        'landscape' => 'json',
        'soil_depth' => 'json',
        'soil_texture' => 'json',
        'drainage' => 'json',
        'soil_ph' => 'json',
        'salinity' => 'json',
        'lime' => 'json',
        'climate' => 'json',
        'community_type' => 'json',
        'associated_species' => 'json',
        'soil_erosion' => 'json',
        'area_sampled' => 'json',
        'specimen_type' => 'json',
        'pollination_type' => 'json',
        'pollination_agent' => 'json',
        'fruit_type' => 'json',
        'date_harvesting' => 'json',
        'life_span' => 'json',
        'growth_form' => 'json',
        'mother_health' => 'json',
        'other_detail' => 'json',
    ];

    public function evaluationCollections()
    {
        return $this->hasMany(evaluationCollection::class)->latest();
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
    public function seedMolecular()
    {
        return $this->hasMany(seedMolecular::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function bioMoleculars()
    {
        return $this->hasMany(BioMolecular::class)->latest();
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

    public function plantApplication()
    {
        return $this->belongsTo(PlantApplication::class, 'plant_application_id');
    }

    public function plants()
    {
        return $this->belongsToMany(Plant::class,
            'seed_plants',
            'seed_id',
            'plant_id');
    }
}
