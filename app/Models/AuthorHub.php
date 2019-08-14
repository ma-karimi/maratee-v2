<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="AuthorHub",
 *            required={"name"},
 * 			@SWG\Property(property="authorable_type", type="string"),
 * 			@SWG\Property(property="authorable_id", type="integer"),
 * 			@SWG\Property(property="author_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class AuthorHub extends BaseModel
{


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded=['id'];


    /**
     * Get all of the posts that are assigned this tag.
     */
    public function plants()
    {
        return $this->morphedByMany(Plant::class, 'author_hubs');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function generals()
    {
        return $this->morphedByMany(General::class, 'author_hubs');
    }
}
