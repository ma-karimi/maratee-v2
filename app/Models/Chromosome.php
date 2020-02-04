<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="Chromosome",
 *            required={"taxonomy_id"},
 *
 */
class Chromosome extends BaseModel implements HasMedia, AuditableContract
{

    use ArticleRelation, Auditable, HasMediaTrait, AuditTrait;

    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'general_class_id' => 'required|exists:generals,id',
        'n_no' => 'nullable|integer',
        'n2_no' => 'nullable|integer',
        'v_number' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chromosomes';
    protected $appends = ['addresses', 'last_audit'];
    protected $with = ['audits'];

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }


    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable', 'location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function generalClass(): BelongsTo
    {
        return $this->belongsTo(General::class)->whereType('class');
    }


    public function getAddressesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('locations') && $this->locations->count()) {
            $item = $this->locations->implode('address_en', ' & ');
        }

        return $item;
    }

}
