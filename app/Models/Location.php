<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Location extends BaseModel
{
    const LOCATION_ID = 'location_id';


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['address_id', 'altitude', 'created_at', 'deleted_at', 'description', 'name', 'point', 'region_id', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class, self::LOCATION_ID)->latest();
    }


    public function chromosomes()
    {
        return $this->hasMany(Chromosome::class, self::LOCATION_ID)->latest();
    }

    public function connections()
    {
        return $this->hasMany(Connection::class, self::LOCATION_ID)->latest();
    }

    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class, self::LOCATION_ID)->latest();
    }
}
