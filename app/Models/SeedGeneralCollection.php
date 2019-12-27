<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedGeneralCollection",
 *      required={"seed_collection_id","seed_general_id"}
 * )
 */
class SeedGeneralCollection extends BaseModel
{

    public static $rules = [
        'seed_collection_id' => 'required|exists:seed_collections,id',
        'seed_general_id' => 'required|exists:seed_generals,id'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_collections';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
