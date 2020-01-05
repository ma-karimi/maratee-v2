<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


trait PaleontologyAccessor
{

    public function getSamplesAttribute()
    {
        $samples = null;

        if ($this->relationLoaded('generalSamples') && $this->generalSamples->count()) {
            $samples = $this->generalSamples->implode('name', ' & ');
        }

        return $samples;
    }
    public function getPreservationsAttribute()
    {
        $text = null;

        if ($this->relationLoaded('generalPreservations') && $this->generalPreservations->count()) {
            $text = $this->generalPreservations->implode('name', ' & ');
        }

        return $text;
    }
}
