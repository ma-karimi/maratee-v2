<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $paleontology_id
 * @property int $article_id
 * @property int $user_id
 * @property int $media_id
 * @property string $plates_no
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Article $article
 * @property Media $media
 * @property Paleontology $paleontology
 * @property User $user
 */
class PG extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'paleontology_citations';

    /**
     * @var array
     */
    protected $fillable = ['paleontology_id', 'article_id', 'user_id', 'media_id', 'plates_no', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo('App\Models\Media');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paleontology()
    {
        return $this->belongsTo('App\Models\Paleontology');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
