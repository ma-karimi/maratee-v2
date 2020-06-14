<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="ActionActor",
 *            required={"actor_id"},
 *        )
 **/
class ActionActor extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_actors';

}
