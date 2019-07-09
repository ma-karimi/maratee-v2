<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Seeds extends BaseModel
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
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'send_date', 'updated_at'];


    public function assessmentCollections()
    {
        return $this->hasMany(AssessmentCollection::class)->latest();
    }

    public function geramins()
    {
        return $this->hasMany(Geramin::class)->latest();
    }
}
