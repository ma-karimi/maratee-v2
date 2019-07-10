<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Herbarium extends BaseModel
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
}
