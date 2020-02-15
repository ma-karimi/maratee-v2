<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="Actor",
 *            required={"name"},
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="user_id", type="integer"),
 * 			@SWG\Property(property="cellphone", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Actor extends BaseModel
{
    public static $rules = [
        'user_id' => 'nullable|integer|exists:users,id',
        'cellphone' => 'nullable|numeric',
        'name' => 'required|min:3',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actors';
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function plants()
    {
        return $this->morphedByMany(Plant::class, 'actorable', 'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function generals()
    {
        return $this->morphedByMany(General::class, 'actorable', 'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }


    /**
     * Get all of the videos that are assigned this tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actions()
    {
        return $this->morphedByMany(ActionHub::class, 'actorable', 'actor_hubs');
    }
}
