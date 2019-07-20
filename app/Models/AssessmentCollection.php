<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="AssessmentCollection",
 *            required={"collection_id", "assessment_id", "seed_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="collection_id", type="integer"),
 * 			@SWG\Property(property="assessment_id", type="integer"),
 * 			@SWG\Property(property="seed_id", type="integer"),
 * 			@SWG\Property(property="department_id", type="integer"),
 * 			@SWG\Property(property="project_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class AssessmentCollection extends BaseModel
{


    public static $rules = [
        'collection_id' => 'required|exists:collections,id',
        'department_id' => 'exists:departments,id',
        'seed_id' => 'exists:seeds,id',
        'assessment_id' => 'exists:assessments,id',
        'project_id' => 'exists:projects,id'
    ];

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

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }
}
