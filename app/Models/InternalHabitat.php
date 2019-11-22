<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="InternalHabitat",
 *            required={"name"}
 *        )
 **/
class InternalHabitat extends BaseModel implements HasMedia
{
    use  HasMediaTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'internal_habitats';

}
