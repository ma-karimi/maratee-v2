<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="ArticleHub",
 *      required={"article_id", "articleable_id", "articleable_type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="articleable_type",
 *          description="cryo_bank, action, location, user, media",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="articleable_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="article_id",
 *          description="article_id",
 *          type="integer",
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
class ArticleHub extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article_hubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['articleable_id', 'articleable_type', 'article_id', 'created_at', 'deleted_at',  'updated_at', ];

    public static $rules = [
        'article_id'=>'required|exists:articles,id',
        'articleable_id'=>'required|integer',
        'articleable_type'=>'required|string'
    ];
}
