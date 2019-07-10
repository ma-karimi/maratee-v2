<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CryoBank extends BaseModel
{
    const CRYO_BANK_ID = 'cryo_bank_id';


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_banks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cell_no', 'created_at', 'deleted_at', 'entry_date', 'geotype_code', 'herbarium_id', 'layering_no', 'protection_id', 'rack_no', 'repetition', 'row_no', 'sample_type', 'tank_no', 'tank_type', 'treatment', 'updated_at', 'voucher_number'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json',
        'tank_type' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'entry_date', 'updated_at'];


    /**
     * @return HasMany
     */
    public function articleHubs(): HasMany
    {
        return $this->hasMany(ArticleHub::class)->latest();
    }


    /**
     * @return HasMany
     */
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function cryoBankActions(): HasMany
    {
        return $this->hasMany(CryoBankAction::class)->latest();
    }


    /**
     * @return BelongsTo
     */
    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }
}
