<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="ConstituentType",
 *            required={"name"},
 *        )
 **/
class ConstituentType extends BaseModel
{

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    public static $rules = ['name' => 'required|string'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'constituent_types';

}
