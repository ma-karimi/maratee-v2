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

//    public function getSamplesAttribute()
//    {
//        $samples = null;
//
//        if ($this->relationLoaded('generalSamples') && $this->generalSamples->count()) {
//            $samples = $this->generalSamples->implode('name', ' & ');
//        }
//
//        return $samples;
//    }

    public function getPreservationAttribute()
    {
        $text = null;

        if ($this->relationLoaded('preservations') && $this->preservations->count()) {
            $text = $this->preservations->implode('name', ' & ');
        }

        return $text;
    }

    public function getCitationAttribute()
    {
        $text = null;

        if ($this->relationLoaded('citations') && $this->citations->count()) {
            $text = $this->citations->implode('name', ' & ');
        }

        return $text;
    }
}
