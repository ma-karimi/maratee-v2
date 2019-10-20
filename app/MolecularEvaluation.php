<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $organization_id
 * @property integer $department_id
 * @property integer $project_id
 * @property integer $specimen_type_collect_id
 * @property string $accession_code
 * @property string $regeneration_and_evaluation_code
 * @property string $treat
 * @property int $repeat
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Department $department
 * @property Organization $organization
 * @property Project $project
 * @property SeedGeneral $seedGeneral
 * @property MolecularEvaluationVar[] $molecularEvaluationVars
 */
class MolecularEvaluation extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['organization_id', 'department_id', 'project_id', 'specimen_type_collect_id', 'accession_code', 'regeneration_and_evaluation_code', 'treat', 'repeat', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'specimen_type_collect_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function molecularEvaluationVars()
    {
        return $this->hasMany('App\Models\MolecularEvaluationVar');
    }
}
