<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Article extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['authors', 'created_at', 'deleted_at', 'journal_name', 'journal_no', 'page_no', 'title', 'type', 'updated_at', 'year'];


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
        return $this->hasMany(ArticleHub::class, 'article_id')->latest();
    }


    public function chromosomes()
    {
        return $this->hasMany(Chromosome::class, 'article_id')->latest();
    }
}
