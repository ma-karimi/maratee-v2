<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="Connection",
 *            required={"location_id", "user_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="location_id", type="integer"),
 * 			@SWG\Property(property="user_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Connection extends BaseModel
{

    public static $linguistically = ['name' => true, 'description' => false];
    public static $rules = [
        'location_id' => 'required|exists:locations,id',
        'user_id' => 'required|exists:users,id'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'connections';

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
