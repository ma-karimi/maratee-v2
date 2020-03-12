<?php


namespace App\Models\Contracts;


use Illuminate\Support\Str;

trait GeneralTrait
{

    public function getNameAttribute($value)
    {
        return Str::ucfirst($value);
    }

    public function getActorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('authors') && $this->authors->count()) {
            $authors = $this->authors->implode('name', ' & ');
        }

        return $authors;
    }

    public function getNameAuthorAttribute()
    {
        $name = $this->name;

        if (!empty($this->actors)) {
            $name .= ' ' . $this->actors;
        }
        return $name;
    }
}
