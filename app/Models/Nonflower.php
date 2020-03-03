<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Scope\NonflowerScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Nonflower",
 *      required={"location_id"","taxonomy_id"}
 * )
 */
class Nonflower extends BaseModel implements HasMedia, AuditableContract
{
    use ActionRelation, HasMediaTrait, NonflowerScope, AuditTrait, Auditable;
    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    public static $rules = [
        'location_id' => 'nullable|exists:locations,id',
        'taxonomy_id' => 'nullable|exists:taxonomies,id',
        'herbarium_number' => 'nullable|string',
        'description' => 'nullable|string',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'nullable|exists:cities,id',
        'province_id' => 'required|exists:provinces,id',
        //classification
        'habitat_id' => 'nullable|exists:generals,id',
        'phytogeography_id' => 'nullable|exists:generals,id',
        'substrate_id' => 'required|exists:nonflower_generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nonflowers';

    protected $appends = ['visit', 'borrow', 'exchange_receive', 'exchange_send', 'last_audit'];
    protected $with = ['audits'];

    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(NonflowerTaxonomy::class)->withTrashed();
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
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


    public function phytogeography(): BelongsTo
    {
        return $this->belongsTo(General::class, 'phytogeography_id')->whereType('phytogeography');
    }


    public function substrate()
    {
        return $this->belongsTo(NonflowerGeneral::class, 'substrate_id')->whereIn('type', ['diatom', 'moss', 'lichen']);
    }


    public function habitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'habitat_id')->whereType('habitat');
    }

}


