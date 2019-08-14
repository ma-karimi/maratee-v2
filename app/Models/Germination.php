<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Germination",
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="dormancy_breaking_treatments",
 *          description="dormancy_breaking_treatments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="light_date",
 *          description="light_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="dark_date",
 *          description="dark_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="light_temperature",
 *          description="light_temperature",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="dark_temperature",
 *          description="dark_temperature",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="germination_period",
 *          description="germination_period",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="germination_percentage",
 *          description="germination_percentage",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="germination_rate",
 *          description="germination_rate"
 *      ),
 *      @SWG\Property(
 *          property="dormancy_termination",
 *          description="dormancy_termination",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="germination_start",
 *          description="germination_start",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="dormancy_breaking_description",
 *          description="dormancy_breaking_description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
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
class Germination extends BaseModel
{
    use SoftDeletes;

    public $table = 'germinations';
    

    protected $dates = ['deleted_at'];


   protected $guarded=['id'];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dormancy_breaking_treatments' =>'string',
        'light_date' =>'date',
        'dark_date' =>'date',
        'dormancy_termination' =>'date',
        'germination_start' =>'date',
        'light_temperature' =>'integer',
        'dark_temperature' =>'integer',
        'germination_period' =>'integer',
        'germination_percentage' =>'integer',
        'dormancy_breaking_description' =>'array',
    ];

    
}
