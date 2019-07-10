<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $herbarium_id
 * @property int $protection_id
 * @property int $department_id
 * @property int $field_code
 * @property string $correct_field_code
 * @property int $sample_code
 * @property int $voucher_no
 * @property mixed $transmittance
 * @property mixed $land_form
 * @property mixed $slope_direction
 * @property mixed $landscape
 * @property int $slope_degree
 * @property mixed $soil_depth
 * @property mixed $density
 * @property mixed $drainage
 * @property mixed $soil_ph
 * @property mixed $salinity
 * @property mixed $lime
 * @property mixed $climate
 * @property mixed $extent_population
 * @property mixed $vegetation
 * @property mixed $soil_erosion
 * @property mixed $land_reforming
 * @property mixed $sample_type
 * @property mixed $flowering
 * @property mixed $pollination
 * @property mixed $pollination_agent
 * @property mixed $fruit_type
 * @property int $seeding_bush_qt
 * @property mixed $collecting_type
 * @property mixed $seeding_month
 * @property mixed $reproduction
 * @property mixed $vegetative_form
 * @property int $height
 * @property mixed $mother_health
 * @property string $send_date
 * @property int $collected_qt
 * @property int $must_collected_qt
 * @property int $critical_extensions_qt
 * @property mixed $notes
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Department $department
 * @property Herbarium $herbarium
 * @property Protection $protection
 * @property AssessmentCollection[] $assessmentCollections
 * @property Geramin[] $geramins
 * @property Media[] $medias
 * @property SeedChemical[] $seedChemicals
 * @property SeedExchange[] $seedExchanges
 * @property SeedHasPlant[] $seedHasPlants
 * @property SeedHub[] $seedHubs
 * @property SeedMolecular[] $seedMoleculars
 * @property SeedPlant[] $seedPlants
 * @property SeedTechnology[] $seedTechnologies
 */
class Seed extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['herbarium_id', 'protection_id', 'department_id', 'field_code', 'correct_field_code', 'sample_code', 'voucher_no', 'transmittance', 'land_form', 'slope_direction', 'landscape', 'slope_degree', 'soil_depth', 'density', 'drainage', 'soil_ph', 'salinity', 'lime', 'climate', 'extent_population', 'vegetation', 'soil_erosion', 'land_reforming', 'sample_type', 'flowering', 'pollination', 'pollination_agent', 'fruit_type', 'seeding_bush_qt', 'collecting_type', 'seeding_month', 'reproduction', 'vegetative_form', 'height', 'mother_health', 'send_date', 'collected_qt', 'must_collected_qt', 'critical_extensions_qt', 'notes', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function herbarium()
    {
        return $this->belongsTo('App\Models\Herbarium');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function protection()
    {
        return $this->belongsTo('App\Models\Protection');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessmentCollections()
    {
        return $this->hasMany('App\Models\AssessmentCollection');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function geramins()
    {
        return $this->hasMany('App\Models\Geramin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany('App\Models\Media');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedChemicals()
    {
        return $this->hasMany('App\Models\SeedChemical');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedExchanges()
    {
        return $this->hasMany('App\Models\SeedExchange');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedHasPlants()
    {
        return $this->hasMany('App\Models\SeedHasPlant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedHubs()
    {
        return $this->hasMany('App\Models\SeedHub');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedMoleculars()
    {
        return $this->hasMany('App\Models\SeedMolecular');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedPlants()
    {
        return $this->hasMany('App\Models\SeedPlant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedTechnologies()
    {
        return $this->hasMany('App\Models\SeedTechnology');
    }
}
