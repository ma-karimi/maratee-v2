<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $name
 * @property mixed $description
 * @property string $type
 * @property int $parent_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MedicinalPlant[] $medicinalPlants
 */
class PlantFactor extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'type', 'parent_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicinalPlants()
    {
        return $this->hasMany('App\Models\MedicinalPlant', 'plant_origin_id');
    }
}
