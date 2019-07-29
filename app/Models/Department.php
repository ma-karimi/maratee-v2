<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Department",
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
class Department extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];

    /**
     * @return HasMany
     */
    public function actionHubs(): HasMany
    {
        return $this->hasMany(ActionHub::class)->latest();
    }

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
    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seeds(): HasMany
    {
        return $this->hasMany(Seed::class, 'department_id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function table()
    {
        return $this->hasOne(Table::class);
    }

    /**
     * @return HasMany
     */
    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
    /**
     * @return HasMany
     */
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
