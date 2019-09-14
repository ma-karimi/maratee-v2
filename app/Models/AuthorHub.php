<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="AuthorHub",
 *            required={"name"},
 * 			@SWG\Property(property="authorable_type", type="string", description="plant, general, chromosome"),
 * 			@SWG\Property(property="authorable_id", type="integer"),
 * 			@SWG\Property(property="author_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class AuthorHub extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'author_hubs';

}
