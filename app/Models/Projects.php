<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Projects extends BaseModel
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
    protected $casts = [];




    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class, 'project_id')->latest();
    }


    public function assessmentCollections()
    {
        return $this->hasMany(AssessmentCollection::class, 'project_id')->latest();
    }
}
