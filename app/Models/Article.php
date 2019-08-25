<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Article",
 *      required={"city_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="journal_no",
 *          description="journal_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="page_no",
 *          description="page_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="year",
 *          description="year",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="journal_name",
 *          description="journal_name",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="auhtors",
 *          description="auhtors",
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
class Article extends BaseModel
{

    public static $linguistically = ['title' => true, 'type' => false, 'authors'=>false, 'journal_name'=>false];
    public static $rules = [
        'year' => 'date',
        'journal_no'=>'integer',
        'page_no'=>'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['title' => 'json', 'type' => 'json', 'authors' => 'json', 'journal_name' => 'json'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'year'];


    public function articleHubs()
    {
        return $this->morphedByMany(ArticleHub::class, 'articleable')->withTimestamps();
    }



    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(UserHub::class, 'userable')->withTimestamps();
    }

    public function chromosomes()
    {
        return $this->hasMany(Chromosome::class, 'article_id')->latest();
    }
}
