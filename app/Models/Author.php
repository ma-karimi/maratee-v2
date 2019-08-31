<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="Author",
 *            required={"name"},
 * 			@SWG\Property(property="name", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="user_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Author extends BaseModel
{
    public static $linguistically = ['name' => true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';
    public static $rules = [
        'user_id'=>'integer|exists:users,id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];



    /**
     * Get all of the posts that are assigned this tag.
     */
    public function plants()
    {
        return $this->morphedByMany(Plant::class, 'authorable','author_hubs')
            ->whereNull('author_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function generals()
    {
        return $this->morphedByMany(General::class, 'authorable','author_hubs')
            ->whereNull('author_hubs.deleted_at')
            ->withTimestamps();
    }



    /**
     * Get all of the videos that are assigned this tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
