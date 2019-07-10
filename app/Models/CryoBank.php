<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

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


    public function articleHubs()
    {
        return $this->hasMany(ArticleHub::class, self::CRYO_BANK_ID)->latest();
    }


    public function chromosomes()
    {
        return $this->hasMany(Chromosome::class, self::CRYO_BANK_ID)->latest();
    }

    public function cryoBankActions()
    {
        return $this->hasMany(CryoBankAction::class, self::CRYO_BANK_ID)->latest();
    }


    public function protection()
    {
        return $this->belongsTo(Protection::class);
    }

    public function herbarium()
    {
        return $this->belongsTo(Herbariums::class);
    }
}
