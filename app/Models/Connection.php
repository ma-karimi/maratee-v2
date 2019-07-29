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
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'department_id', 'user_id', 'location_id', 'updated_at'];


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
