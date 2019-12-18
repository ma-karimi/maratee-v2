<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PlantGeographical",
 *      required={"plant_id","geographical_ids"}
 * )
 */

class PlantGeographical extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_geographicals';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public static $rules = [
        'plant_id' => 'required|exists:plants,id',
        'geographical_ids.*' => 'required|exists:geographicals,id'
    ];

    protected $appends = ['name'];


    public function geographical()
    {
        return $this->belongsTo(Geographical::class);
    }

    public function getNameAttribute()
    {
        $item = null;

        if ($this->relationLoaded('geographical') && $this->geographical) {
            $item = $this->geographical['name'];
        }

        return $item;
    }
}
