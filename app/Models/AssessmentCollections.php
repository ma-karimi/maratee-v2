<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class AssessmentCollections extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assessment_collections';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['assessment_id', 'collection_id', 'created_at', 'deleted_at', 'department_id', 'project_id', 'seed_id', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];



    public function assessment()
    {
        return $this->belongsTo(Assessments::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collections::class);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function seed()
    {
        return $this->belongsTo(Seeds::class);
    }
}
