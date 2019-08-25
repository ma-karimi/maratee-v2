<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="EntryHub",
 *            required={"type"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="location_id", type="integer"),
 * 			@SWG\Property(property="entry_id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="organization_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class EntryHub extends BaseModel
{
    public static $rules = [
        'location_id' => 'required|exists:locations,id',
        'entry_id' => 'required|exists:entries,id',
        'botanical_id' => 'required|exists:botanicals,id',
        'organization_id' => 'required|exists:organizations,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entry_hubs';

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
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    /**
     * @return BelongsTo
     */
    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

}
