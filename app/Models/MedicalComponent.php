<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="MedicalComponent",
 *            required={"medical_id", "component_id", "is_active"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="medical_id", type="integer"),
 * 			@SWG\Property(property="component_id", type="integer"),
 * 			@SWG\Property(property="is_active", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/

class MedicalComponent extends BaseModel
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['medical_id', 'component_id', 'is_active', 'created_at', 'deleted_at', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['is_active'=>'bool'];


}
