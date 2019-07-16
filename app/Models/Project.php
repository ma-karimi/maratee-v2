<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
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
 *          property="name",
 *          description="name",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="plan_name",
 *          description="name",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="plan_description",
 *          description="plan_description",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="plan_number",
 *          description="plan_number",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="approved_id",
 *          description="approved_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="registered_id",
 *          description="registered_id",
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
