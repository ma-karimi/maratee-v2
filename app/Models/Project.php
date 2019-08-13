<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Project",
 *      required={"name","plan_name","plan_number"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="project_leader_id",
 *          description="project_leader_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="research_leader_id",
 *          description="research_leader_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="research_title",
 *          description="research_title",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="plan_name",
 *          description="name",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="plan_description",
 *          description="plan_description",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="plan_number",
 *          description="plan_number",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="project_no",
 *          description="project_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="research_no",
 *          description="research_no",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *          property="plan_id",
 *          description="plan_id",
 *          type="integer",
 *          format="int32"
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

class Project extends BaseModel
{
    public static $linguistically=['title'=>true,'plan_name'=>true,'research_title'=>false];
    public static $rules=[
        'approved_id' => 'string',
        'registered_id' => 'string',
        'plan_id' => 'integer',
        'project_leader_id' => 'integer',
        'research_leader_id' => 'integer',
    ];

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
    protected $guarded=['id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'json',
        'plan_name' => 'json',
        'research_title' => 'json'
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
    public function evaluationCollections(): HasMany
    {
        return $this->hasMany(evaluationCollection::class, 'project_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs(): HasMany
    {
        return $this->hasMany(SeedHub::class)->latest();
    }
    /**
     * @return BelongsTo
     */
    public function projectLeader(): BelongsTo
    {
        return $this->belongsTo(User::class,'project_leader_id');
    }
    /**
     * @return BelongsTo
     */
    public function researchLeader(): BelongsTo
    {
        return $this->belongsTo(User::class,'research_leader_id');
    }
}
