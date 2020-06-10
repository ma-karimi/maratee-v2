<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Distribution",
 *      required={"name"},
 *     }
 */
class Distribution extends BaseModel
{

    public static $rules = [
        'name' => 'required|string',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function botanicals()
    {
        return $this->morphedByMany(Botanical::class, 'distributable');
    }
}
