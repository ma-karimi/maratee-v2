<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Collection",
 *            required={"name"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Collection extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collections';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'name', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * @return HasMany
     */
    public function assessmentCollections(): HasMany
    {
        return $this->hasMany(AssessmentCollection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function geramins(): HasMany
    {
        return $this->hasMany(Geramin::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedExchanges(): HasMany
    {
        return $this->hasMany(SeedExchange::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function technologyCollections(): HasMany
    {
        return $this->hasMany(TechnologyCollection::class)->latest();
    }
}
