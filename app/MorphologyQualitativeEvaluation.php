<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $collect_id
 * @property integer $organization_id
 * @property integer $department_id
 * @property integer $project_id
 * @property integer $taxonomy_id
 * @property integer $station_id
 * @property string $accession_code
 * @property string $regeneration_and_evaluation_code
 * @property string $voucher_no
 * @property integer $replication_or_block_number
 * @property string $observation
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property SeedGeneral $seedGeneral
 * @property Department $department
 * @property Organization $organization
 * @property Project $project
 * @property Station $station
 * @property Taxonomy $taxonomy
 * @property MorphologyQualitativeEvaluationVar[] $morphologyQualitativeEvaluationVars
 */
class MorphologyQualitativeEvaluation extends Model
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
    protected $fillable = ['collect_id', 'organization_id', 'department_id', 'project_id', 'taxonomy_id', 'station_id', 'accession_code', 'regeneration_and_evaluation_code', 'voucher_no', 'replication_or_block_number', 'observation', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'collect_id');
    }

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
    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo('App\Models\Taxonomy');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function morphologyQualitativeEvaluationVars()
    {
        return $this->hasMany('App\Models\MorphologyQualitativeEvaluationVar', 'evaluation_id');
    }
}
