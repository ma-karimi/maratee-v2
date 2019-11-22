<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Place",
 *      required={"name_en"},
 * )
 */
class Place extends BaseModel
{

    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'places';

}
