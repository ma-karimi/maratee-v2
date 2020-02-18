<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Country",
 *            required={"name_en"}
 *
 */
class Country extends BaseModel
{

    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class)->latest();
    }

}
