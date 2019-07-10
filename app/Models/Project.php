<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['approved_id', 'created_at', 'deleted_at', 'name', 'plan_description', 'plan_id', 'plan_name', 'plan_number', 'registered_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'plan_name' => 'json',
        'plan_description' => 'json',
        'plan_number' => 'json',
    ];


    /**
     * @return HasMany
     */
    public function actionHubs(): HasMany
    {
        return $this->hasMany(ActionHub::class, 'project_id')->latest();
    }


    /**
     * @return HasMany
     */
    public function assessmentCollections(): HasMany
    {
        return $this->hasMany(AssessmentCollection::class, 'project_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs(): HasMany
    {
        return $this->hasMany(SeedHub::class)->latest();
    }
}
