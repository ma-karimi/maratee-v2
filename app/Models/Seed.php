<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Seed extends BaseModel
{


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedHubs()
    {
        return $this->hasMany('App\Models\SeedHub');
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
    public function seedTechnologies()
    {
        return $this->hasMany('App\Models\SeedTechnology');
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
    public function seedChemicals()
    {
        return $this->hasMany('App\Models\SeedChemical');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany('App\Models\Media');
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
