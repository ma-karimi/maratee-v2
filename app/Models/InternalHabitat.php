<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="InternalHabitat",
 *            required={"name_en"}
 *        )
 **/
class InternalHabitat extends BaseModel implements HasMedia
{
    use  HasMediaTrait;

    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'nullable|string'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'internal_habitats';

}
