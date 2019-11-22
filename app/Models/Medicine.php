<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Medicine",
 *      required={"name_en"},
 * )
 */
class Medicine extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicines';

}
