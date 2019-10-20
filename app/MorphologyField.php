<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $station_id
 * @property integer $location_id
 * @property integer $collect_id
 * @property integer $field_or_greenhouse
 * @property string $soil_ph
 * @property string $soil_ec
 * @property string $soil_depth
 * @property string $sand
 * @property string $loam
 * @property string $clay
 * @property string $n
 * @property string $p
 * @property string $k
 * @property string $soil_organic_matter
 * @property string $source_of_water
 * @property string $irrigation_system
 * @property string $irrigation_circuit
 * @property string $irrigation_time
 * @property string $flow_rate
 * @property string $water
 * @property string $water_ec
 * @property string $meteorological_station_data
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property SeedGeneral $seedGeneral
 * @property Location $location
 * @property Station $station
 */
class MorphologyField extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['station_id', 'location_id', 'collect_id', 'field_or_greenhouse', 'soil_ph', 'soil_ec', 'soil_depth', 'sand', 'loam', 'clay', 'n', 'p', 'k', 'soil_organic_matter', 'source_of_water', 'irrigation_system', 'irrigation_circuit', 'irrigation_time', 'flow_rate', 'water', 'water_ec', 'meteorological_station_data', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'collect_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }
}
