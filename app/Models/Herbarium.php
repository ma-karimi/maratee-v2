<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Scope\HerbariumScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Herbarium",
 *      required={"location_id","organization_id","taxonomy_id"}
 * )
 */
class Herbarium extends BaseModel implements HasMedia, AuditableContract
{
    use HasMediaTrait, HerbariumScope, AuditTrait, Auditable;

    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    public static $rules = [
        'organization_id' => 'required|exists:organizations,id',
        'location_id' => 'nullable|exists:locations,id',
        'taxonomy_id' => 'nullable|exists:taxonomies,id',
        'herbarium_number' => 'nullable|string',

        'description' => 'nullable|string',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'nullable|exists:cities,id',
        'province_id' => 'required|exists:provinces,id',
        //classification
        'general_habitat_id' => 'nullable|exists:generals,id',
        'general_phytogeography_id' => 'nullable|exists:generals,id',
        'general_substrate_id' => 'required_if:is_flowering,0|exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbariums';

    protected $appends = ['tip_picture', 'visit', 'borrow', 'exchange_receive', 'exchange_send', 'last_audit', 'collector', 'determiner'];
    protected $with = ['audits', 'collectors', 'determiners'];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'taxonomy_id', 'taxonomy_id');
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
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


    public function generalPhytogeography(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_phytogeography_id')->whereType('phytogeography');
    }


    public function generalSubstrate()
    {
        return $this->belongsTo(General::class, 'general_substrate_id')->whereIn('type', ['diatom', 'moss', 'lichen']);
    }


    public function generalHabitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id')->whereType('habitat');
    }


    public function determiners(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable', 'action_actors')->withTimestamps()
            ->where('action_actors.type_id', 1)
            ->whereNull('action_actors.deleted_at');
    }

    public function collectors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable', 'action_actors')->withTimestamps()
            ->where('action_actors.type_id', 2)
            ->whereNull('action_actors.deleted_at');
    }


    public function getCollectorAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('collectors') && $this->collectors->count()) {
            $authors = $this->collectors->implode('name', ' & ');
        }

        return $authors;
    }


    public function getDeterminerAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('determines') && $this->determines->count()) {
            $authors = $this->determines->implode('name', ' & ');
        }

        return $authors;
    }

}


