<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @SWG\Definition(
 *            definition="InternalHabitat",
 *            required={"name_en"}
 *        )
 **/
class InternalHabitat extends BaseModel implements HasMedia
{
    use  InteractsWithMedia;

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
