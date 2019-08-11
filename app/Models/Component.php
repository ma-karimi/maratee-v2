<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Krlove\EloquentModelGenerator\Model\HasMany;

/**
 * @SWG\Definition(
 *            definition="Component",
 *            required={"name"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="description", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/

class Component extends BaseModel
{

    public static $linguistically=['name'=>true, 'description'=>true];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'created_at', 'deleted_at', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json','description' => 'json'];


    /**
     * @return BelongsToMany
     */
    public function medicals(): BelongsToMany
    {
        return $this->belongsToMany(Medical::class, 'medical_components');
    }

}
