<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Herbariums extends BaseModel
{
    const HERBARIUM_ID = 'herbarium_id';


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
    protected $fillable = ['created_at', 'deleted_at', 'description', 'flowering', 'herbarium_tip_location', 'is_flowering', 'location_id', 'name', 'number', 'organization_description', 'organization_id', 'phenology_id', 'physical_tip_qt', 'phytogeography_id', 'plant_group_id', 'plant_type_id', 'protection_id', 'samples_no', 'sheets_no', 'tip_qt', 'tip_type', 'type_description', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class, self::HERBARIUM_ID)->latest();
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, self::HERBARIUM_ID)->latest();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, self::HERBARIUM_ID)->latest();
    }

    public function chromosomes()
    {
        return $this->hasMany(Chromosome::class, self::HERBARIUM_ID)->latest();
    }

    public function cryoBanks()
    {
        return $this->hasMany(CryoBank::class, self::HERBARIUM_ID)->latest();
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, ['send_herbarium_id', 'receive_herbarium_id'])->latest();
    }
}
