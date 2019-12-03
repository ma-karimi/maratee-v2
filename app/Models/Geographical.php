<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Geographical",
 *      required={"name"},
 *     }
 */
class Geographical extends BaseModel
{

    public static $rules = [
        'name' => 'required|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geographicals';

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function plants()
    {
        return $this->morphedByMany(Plant::class, 'distributable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function botanicals()
    {
        return $this->morphedByMany(Botanical::class, 'distributable');
    }
}
