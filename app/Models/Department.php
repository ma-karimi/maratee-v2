<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Department extends BaseModel
{
    const DEPARTMENT_ID = 'department_id';


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


    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class, self::DEPARTMENT_ID)->latest();
    }


    public function assessmentCollections()
    {
        return $this->hasMany(AssessmentCollection::class, self::DEPARTMENT_ID)->latest();
    }

    public function connections()
    {
        return $this->hasMany(Connection::class, self::DEPARTMENT_ID)->latest();
    }

}
