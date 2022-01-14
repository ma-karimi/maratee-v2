<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 * )
 */
class SeedWeight extends BaseModel implements HasMedia, AuditableContract
{
    use InteractsWithMedia, Auditable, AuditTrait;

    public static $rules = [
        'accession_code' => 'required|string',
//        'seed_collection_id' => 'required|exists:seed_collections,id',
        'collection_id' => 'required|exists:seed_generals,id',
        'thousand_fruits_weight' => 'nullable|numeric',
        'thousand_seeds_weight' => 'nullable|numeric',
        'total_fruit_weight' => 'nullable|numeric',
        'total_seed_weight' => 'nullable|numeric',
//        'collected_seeds_no' => 'required|numeric',
        'banked' => 'nullable|date'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';

    protected $with = ['audits'];
    protected $appends = ['last_audit'];
    protected $casts = ['specimen_type_collections' => 'json'];

    /**
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \JsonException
     */
    public function __construct(array $attributes = array())
    {
        $specimen_type_collections = [];
        if (request()->get('collection_name') == 'Active Collection') {
            $specimen_type_collections = ['Seed in Active Collection', 'Fruit in Active Collection'];
        }
        if (request()->get('collection_name') == 'Base Collection') {
            $specimen_type_collections = ['Seed in Base Collection', 'Fruit in Base Collection'];
        }
        if (request()->get('collection_name') == 'Duplicate Collection') {
            $specimen_type_collections = ['Seed in Duplicate Collection', 'Fruit in Duplicate Collection'];
        }
        if (request()->get('collection_name') == 'Regenerated in Base Collection') {
            $specimen_type_collections = ['Regenerated Seed in Base Collection', 'Regenerated Fruit in Base Collection'];
        }
        if (request()->get('collection_name') == 'Regenerated in Active Collection') {
            $specimen_type_collections = ['Regenerated Seed in Active Collection', 'Regenerated Fruit in Active Collection'];
        }
        if (request()->get('collection_name') == 'Regenerated in Duplicate Collection') {
            $specimen_type_collections = ['Regenerated Seed in Duplicate Collection', 'Regenerated Fruit in Duplicate Collection'];
        }
        $this->setRawAttributes(
            array(
                'specimen_type_collections' => json_encode($specimen_type_collections, JSON_THROW_ON_ERROR),
            ), true
        );
        parent::__construct($attributes);
    }

    /**
     * @return BelongsTo
     */
    public function seedCollection(): BelongsTo
    {
        return $this->belongsTo(SeedCollection::class, 'accession_code', 'accession_code');
    }

    /**
     * @return BelongsTo
     */
    public function specimenType(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }

    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 28);
    }


    /**
     * @return HasMany
     */
    public function seed_exchanges(): HasMany
    {
        return $this->hasMany(SeedExchange::class, 'seed_weight_id');
    }

    public function scopeByCollection($query, $collection_id)
    {
        return $query->where('collection_id', $collection_id);
    }

    public function scopeBySpecimenType($query, $specimen_type_id)
    {
        return $query->where('specimen_type_id', $specimen_type_id);
    }

    public function scopeBySeedCollection($query, $seed_collection_id)
    {
        return $query->where('seed_collection_id', $seed_collection_id);
    }
}
