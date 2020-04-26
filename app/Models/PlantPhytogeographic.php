<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PlantPhytogeographics",
 *      required={"phytogeography_id", "plant_id"},
 * )
 */
class PlantPhytogeographic extends BaseModel
{

    public static $rules = [
        'phytogeography_id' => 'required|exists:generals,id',
        'plant_id' => 'required||exists:plants,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_phytogeographics';
}
