<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="PaleontologyMap",
 *      required={"paleontology_id", "reference"},
 * )
 */
class PaleontologyMap extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    public $table = 'paleontology_maps';

    public function paleontology()
    {
        return $this->belongsTo(Paleontology::class);
    }

}
