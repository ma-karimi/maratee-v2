<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Contracts\GeneralTrait;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="ExoticGeneral",
 *      required={"name","type"}
 * )
 */
class ExoticGeneral extends BaseModel
{
    use GeneralScope, GeneralTrait;

    public const TYPES = ['species', 'sub_species', 'variety', 'family', 'genus'];
    public static $rules = array(
        'name' => 'required|string',
        'type' => 'required|string',
    );
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'type'];

}
