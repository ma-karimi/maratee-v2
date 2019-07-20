<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Credential",
 *            required={"name", "type", "date"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="parent_id", type="integer"),
 * 			@SWG\Property(property="type", type="string"),
 * 			@SWG\Property(property="date", type="string"),
 * 			@SWG\Property(property="archive_no", type="string"),
 * 			@SWG\Property(property="place", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Credential extends BaseModel
{
    public const PARENT_ID = 'parent_id';

    public static $rules = [
        'parent_id' => 'required|exists:credentials,id',
        'type' => 'required|string',
        'archive_no' => 'string',
        'place' => 'string',
        'date' => 'required|date',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credentials';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['archive_no', 'created_at', 'date', 'deleted_at', 'name', 'parent_id', 'place', 'type', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany(self::class, self::PARENT_ID)->latest();
    }


    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, self::PARENT_ID);
    }

    /**
     * @return HasMany
     */
    public function paleontologyMedias(): HasMany
    {
        return $this->hasMany(PaleontologyMedia::class, ['credential_correspondence_id', 'credential_expense_id', 'credential_fair_id', 'credential_gift_id', 'credential_purchase_id'])->latest();
    }
}
