<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Technology",
 *      required={"project_id","seed_technology_id", "seed_id", "department_id", "evaluation_id", "germination_id", "seed_weight_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="germination_id",
 *          description="germination_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="seed_technology_id",
 *          description="germination_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="project_id",
 *          description="germination_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="germination_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="evaluation_id",
 *          description="evaluation_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="seed_weight_id",
 *          description="seed_weight_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="fridge_type",
 *          description="fridge_type",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="regeneration_evaluation",
 *          description="regeneration_evaluation",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Technology extends BaseModel
{

    public static $rules=[
        'seed_technology_id' => 'required|exists:seed_technologies,id',
        'evaluation_id' => 'required|exists:evaluations,id',
        'seed_weight_id' => 'required|exists:seed_weights,id',
        'germination_id' => 'required|exists:germinations,id',
        'seed_id' => 'required|exists:seeds,id',
        'department_id' => 'required|exists:departments,id',
        'project_id' => 'required|exists:projects,id',
        'fridge_type' => 'integer',
        'regeneration_evaluation' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'technologies';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function seedTechnology()
    {
        return $this->belongsTo(SeedTechnology::class, 'seed_technology_id');
    }
    public function germination()
    {
        return $this->belongsTo(Germination::class, 'germination_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function seedWeight()
    {
        return $this->belongsTo(SeedWeight::class, 'seed_weight_id');
    }



    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(UserHub::class, 'userable')->withTimestamps();
    }
}
