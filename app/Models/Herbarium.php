<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Herbarium",
 *      required={"location_id","organization_id","taxonomy_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_number",
 *          description="herbarium_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="organization_id",
 *          description="organization_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_index",
 *          description="herbarium_index",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cf",
 *          description="cf",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string",
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
class Herbarium extends BaseModel implements HasMedia
{
    use ActionRelation, HasMediaTrait;
    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    public static $rules = [
        'organization_id' => 'required|exists:organizations,id',
        'location_id' => 'required|exists:locations,id',
        'taxonomy_id' => 'exists:taxonomies,id',
        'herbarium_number' => 'string',
        'herbarium_index' => 'string',
        'cf' => 'string',
        'description' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbariums';

    protected $appends = ['tip_picture', 'visit', 'borrow', 'exchange_receive', 'exchange_send'];

    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function getTipPictureAttribute()
    {
        return !empty($this->attributes['tip_picture_id']) ? Arr::get(self::BOOLEAN, $this->attributes['tip_picture_id']) : null;
    }

    public function getExchangeReceiveAttribute()
    {
        return $this->transactions()
            ->where('type_id', array_search('exchange', Transaction::TYPE))
            ->where('mode_id', array_search('receive', Transaction::MODE))
            ->first();
    }

    /**
     * @return MorphMany
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable')
            ->whereNull('deleted_at');
    }

    public function getExchangeSendAttribute()
    {
        return $this->transactions()
            ->where('type_id', array_search('exchange', Transaction::TYPE))
            ->where('mode_id', array_search('send', Transaction::MODE))
            ->first();
    }

    public function getBorrowAttribute()
    {
        return $this->transactions()->where('type_id', array_search('borrow', Transaction::TYPE))->first();
    }

    public function getVisitAttribute()
    {
        return $this->transactions()->where('type_id', array_search('visit', Transaction::TYPE))->first();
    }

}


